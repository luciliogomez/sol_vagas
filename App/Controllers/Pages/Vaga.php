<?php
namespace App\Controllers\Pages;

use App\Models\Vaga as ModelsVaga;
use App\Utils\View;
use Exception;
use WilliamCosta\DatabaseManager\Pagination;
use App\Utils\Alert;

class Vaga extends PagesBaseController{

    /**
     * @param Request $request
     */
    public static function index($request)
    {
        $queryParams = $request->getQueryParams();
        $vagasModel = new ModelsVaga();
        $vagas = [];
        $pagination = null;
        // filtering
        $titulo = isset($queryParams['search'])?($queryParams['search']):'';

        try{
            $total = count((isset($titulo)?$vagasModel->search($titulo,'','','','') : $vagasModel->read()) );

            $page = $queryParams['page']?? '1';
            
            $pagination = new Pagination($total,$page,2);

            $vagas =(isset($titulo))?$vagasModel->search($titulo,'','','','',$pagination->getLimit()):  $vagasModel->read($pagination->getLimit());

        }catch(Exception $ex)
        {
            $vagas = [];
            $pagination = null;
        }

        return View::render("vagas::lista",[
                "vagas" => $vagas,
                "links" => self::getPagination($pagination,$request,(isset($titulo)?$titulo:null),null,null,null,null)
            ]
        );
    }
    public static function filtrarVagas($request)
    {
        $queryParams = $request->getQueryParams();
        $vagasModel = new ModelsVaga();
        $vagas = [];
        $pagination = null;
        // filtering
        $titulo = isset($queryParams['search'])?($queryParams['search']):'';
        $area   = isset($queryParams['area'])? ($queryParams['area']):'';
        $modalidade   = isset($queryParams['modalidade'])? ($queryParams['modalidade']):'';
        $formato   = isset($queryParams['formato'])? ($queryParams['formato']):'';
        $cidade   = isset($queryParams['cidade'])? ($queryParams['cidade']):'';

        try{
            $total = count($vagasModel->search($titulo,$area,$modalidade,$formato,$cidade));

            $page = $queryParams['page'] ?? '1';
            
            $pagination = new Pagination($total,$page,2);

            $vagas =$vagasModel->search($titulo,$area,$modalidade,$formato,$cidade,$pagination->getLimit());

        }catch(Exception $ex)
        {
            $vagas = [];
            $pagination = null;
        }

        return View::render("vagas::lista",[
                "vagas"      => $vagas,
                "area"       => $area,
                "titulo"     => $titulo,
                "modalidade" => $modalidade,
                "formato"    => $formato,
                "cidade"     =>$cidade,
                "links"      => self::getPagination($pagination,$request,$titulo,$area,$modalidade,$formato,$cidade)
            ]
        );
    }

    public static function getVagasFiltered($request)
    {
        $queryParams = $request->getQueryParams();
        $postVars    = $request->getPostVars();
        if(isset($postVars['pesquisa'])){
            
            $area = isset($queryParams['area'])?"&area=".$queryParams['area']:'';
            $modalidade = isset($queryParams['modalidade'])?"&modalidade=".$queryParams['modalidade']:'';
            $formato = isset($queryParams['formato'])?"&formato=".$queryParams['formato']:'';
            $cidade = isset($queryParams['cidade'])?"&cidade=".$queryParams['cidade']:'';
            $titulo = $postVars['pesquisa'];
            $request
                ->getRouter()
                    ->redirect("/vagas/filter?search={$titulo}{$area}{$modalidade}{$formato}{$cidade}");
        }
        else if( isset($postVars['area']) || isset($postVars['formato']))
        {
            $area = $postVars['area'];
            $modalidade = $postVars['modalidade'];
            $formato = $postVars['formato'];
            $cidade = $postVars['cidade'];
            $titulo = (isset($queryParams['search']))?$queryParams['search']:'';
            $request
                ->getRouter()
                    ->redirect("/vagas/filter?search={$titulo}&area={$area}&modalidade={$modalidade}&formato={$formato}&cidade={$cidade}");
        }
    }

    public static function getVaga($request,$id)
    {
        $vagasModel = new ModelsVaga();
        try{
            $vaga = $vagasModel->load($id);

            if($vaga instanceof ModelsVaga){
                return View::render("vagas::show",[
                    "vaga" => $vaga,
                    "candidatei_me" => ($vagasModel->isCandidato($_SESSION['usuario']['id'],$id))
                ]);    
            }else{
                return View::render("error::error",[
                    "code" => 404,
                    "message" => "VAGA NÃO ENCONTRADA"
                ]);    
            }

        }catch(Exception $ex){
            return View::render("error::error",[
                "code" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public static function getAplicarVaga($request,$id)
    {
        $vagasModel = new ModelsVaga();
        try{
            $vaga = $vagasModel->load($id);

            if($vaga instanceof ModelsVaga){
                return View::render("vagas::aplicar",[
                    "vaga" => $vaga,
                    "status" => self::getStatus($request)
                ]);    
            }else{
                return View::render("error::error",[
                    "code" => 404,
                    "message" => "VAGA NÃO ENCONTRADA"
                ]);    
            }

        }catch(Exception $ex){
            return View::render("error::error",[
                "code" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    public static function setAplicarVaga($request,$id)
    {
        $vagasModel = new ModelsVaga();
        try{
            $vaga = $vagasModel->load($id);

            if($vaga instanceof ModelsVaga){
                
                if($vagasModel->aplicarVaga($_SESSION['usuario']['id'],$vaga->getId())){
                    $request->getRouter()->redirect("/vagas/{$vaga->getId()}/ver");
                }else{
                    return View::render("vagas::aplicar",[
                        "vaga" => $vaga,
                        "status" => Alert::getError("Ocorreu um Erro. Tente Novamente Mais Tarde")
                    ]);  
                }
                
            }else{
                return View::render("vagas::aplicar",[
                    "vaga" => $vaga,
                    "status" => Alert::getError("Ocorreu um Erro. Tente Novamente Mais Tarde")
                ]);     
            }

        }catch(Exception $ex){
            return View::render("vagas::aplicar",[
                "vaga" => $vaga,
                "status" => Alert::getError("Ocorreu um Erro. Tente Novamente Mais tarde")
            ]);     
        }
    }

    public static function getStatus($request)
    {
        $queryParams = $request->getQueryParams();
        if(!isset($queryParams['status'])){
            return "";
        }
        switch($queryParams['status'])
        {
            case "empty":
                return Alert::getError("Preencha os campos obrigatorios!");
                break;
            case "updated":
                return Alert::getSucess("Dados Guardados!");
                break;
            case "error":
                return Alert::getError("Ocorreu um Erro. Tente novamente!");
                break;
            case "wrong_pass":
                return Alert::getError("Palavra-passe Errada!");
                break;
        }
    }


}