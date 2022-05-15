<?php
namespace App\Controllers\Pages;

use App\Models\Vaga as ModelsVaga;
use App\Utils\View;
use Exception;
use WilliamCosta\DatabaseManager\Pagination;

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

        try{
            $total = count((isset($queryParams['search']) ?$vagasModel->search($queryParams['search']) : $vagasModel->read()) );

            $page = $queryParams['page']?? '1';
            
            $pagination = new Pagination($total,$page,1);

            $vagas =(isset($queryParams['search']))?$vagasModel->search($queryParams['search'],$pagination->getLimit()):  $vagasModel->read($pagination->getLimit());

        }catch(Exception $ex)
        {
            $vagas = [];
            $pagination = null;
        }

        return View::render("vagas::lista",[
                "vagas" => $vagas,
                "links" => self::getPagination($pagination,$request,(isset($queryParams['search'])?$queryParams['search']:null))
            ]
        );
    }

    public static function getVagasFiltered($request)
    {
        $queryParams = $request->getQueryParams();
        $postVars    = $request->getPostVars();
        if(isset($postVars['pesquisa'])){
            $request->getRouter()->redirect("/vagas?search={$postVars['pesquisa']}");
        }
        $vagasModel = new ModelsVaga();
        $vagas = [];
        $pagination = null;

        try{
            $total = count($vagasModel->read());

            $page = $queryParams['page']?? '1';
            
            $pagination = new Pagination($total,$page,4);

            $vagas = $vagasModel->read($pagination->getLimit());

        }catch(Exception $ex)
        {
            $vagas = [];
            $pagination = null;
        }

        return View::render("vagas::lista",[
                "vagas" => $vagas,
                "links" => self::getPagination($pagination,$request)
            ]
        );
    }

    public static function getVaga($request,$id)
    {
        $vagasModel = new ModelsVaga();
        try{
            $vaga = $vagasModel->load($id);

            if($vaga instanceof ModelsVaga){
                return View::render("vagas::show",[
                    "vaga" => $vaga
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


}