<?php
namespace App\Controllers\Pages;
use App\Utils\View;

class PagesBaseController{

  protected static function getPrevLink($pages, $request,$search = null,$area=null,$modalidade=null,$formato=null,$cidade=null){   
    $search = strlen($search)? $search : '';
    $area = strlen($area)?$area:'';
    $modalidade = strlen($modalidade)?$modalidade:'';
    $formato = strlen($formato)?$formato:'';
    $cidade = strlen($cidade)?$cidade:'';
        $links = '';
        foreach($pages as $page)
        {
            $pageNumber = 0;
            if($page['current']){
              $pageNumber = intval($page['page']);  
              
              if( ($pageNumber) == 1 ){
                $link = $request->getURI()."?page=".$page['page'].$search.$area.$modalidade.$formato.$cidade;
                
                  return View::render("pagination::item_left",[
                    'link' => $link,
                    'disabled' => 'disabled'
                  ]);
              }else{
                $link = $request->getURI()."?page=".($pageNumber - 1).$search.$area.$modalidade.$formato.$cidade;
               
                return View::render("pagination::item_left",[
                  'link' => $link,
                  'disabled' => ''
                ]);
              }
            
            }
      }
  }
        
        
    protected static function getNextLink($pages, $request,$search = null,$area=null,$modalidade=null,$formato=null,$cidade=null){
     
      $search = strlen($search)? $search : '';
        $area = strlen($area)?$area:'';
    $modalidade = strlen($modalidade)?$modalidade:'';
    $formato = strlen($formato)?$formato:'';
    $cidade = strlen($cidade)?$cidade:'';
        $links = '';
        foreach($pages as $page)
        {
            $pageNumber = 0;
            if($page['current']){
              $pageNumber = intval($page['page']);  
              
              if( ($pageNumber + 1) > count($pages) ){
                $link = $request->getURI()."?page=".$page['page'].$search.$area.$modalidade.$formato.$cidade;
                  return View::render("pagination::item_right",[
                    'link' => $link,
                    'disabled' => 'disabled'
                  ]);
              }else{
                $link = $request->getURI()."?page=".($pageNumber + 1).$search.$area.$modalidade.$formato.$cidade;
                return View::render("pagination::item_right",[
                  'link' => $link,
                  'disabled' => ''
                ]);
              }
            
            }
        }
        }
        
        protected static function getPagination($pagination,$request,$search = null,$area=null,$modalidade=null,$formato=null,$cidade=null){
        $search = strlen($search)? "&search=".$search: '';
        $area= strlen($area)? "&area=".$area: '';
        $modalidade = strlen($modalidade)? "&modalidade=".$modalidade: '';
        $formato = strlen($formato)? "&formato=".$formato: '';
        $cidade = strlen($cidade)? "&cidade=".$cidade: '';
        $links = '';
        if($pagination == null)return;
        $totalPages = count($pagination->getPages());
        $lastPage = $pagination->getPages()[$totalPages-1]?? '';
        $lastPage = $lastPage['page']??'';
        foreach($pagination->getPages() as $page)
        {
            $link = $request->getURI()."?page=".$page['page'].$search.$area.$modalidade.$formato.$cidade;
            
            if($totalPages > 10 && intval($page['page'])>10)
            {
                $jump = 2;
                if(intval($lastPage) <= 20)
                {
                    $jump = 2;
                }
                else if(intval($lastPage) <= 40)
                {
                    $jump = 4;
                }
                else{
                    $jump = 5;
                }
                $penultima = intval($lastPage)-1;
                $antePenultima = $penultima-1;
                $proximo = null;
                
                $anterior = (intval($page['page'])) - 1;
                $prev = $pagination->getPages()[$anterior-1];
                
                if( (intval($page['page']) % $jump == 0 ) || (intval($page['page']) == intval($lastPage)) 
                || ( intval($page['page']) == $penultima) || ( intval($page['page']) == $antePenultima ) 
                || $page['current'] || $prev['current']){
                    
                    $links .= View::render("pagination::item",[
                        'link' => $link,
                        'item' => $page['page'],
                        'active' => ($page['current'])? 'active' :''
                    ]);
                }
        
            }else{
                
                $links .= View::render("pagination::item",[
                    'link' => $link,
                    'item' => $page['page'],
                    'active' => ($page['current'])? 'active' :''
                ]);
        
            }
        }
        $prevLinK = self::getPrevLink($pagination->getPages(),$request,$search,$area,$modalidade,$formato,$cidade);
        $nextLink = self::getNextLink($pagination->getPages(),$request,$search,$area,$modalidade,$formato,$cidade);
        return View::render("pagination::box",[
            "left" => $prevLinK,
            "links"=> $links,
            "right"=> $nextLink
        ]);
        }       
}