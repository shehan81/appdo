<?php
class ProductController extends BaseController {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function indexAction(){
        $products = Product::all();
        $this->data['products'] = $products;
    }
    
    public function editAction(){
        $params = $this->getParams();
        $id = isset($params['id']) ? $params['id'] : null;
        
        if($id){
            $product = Product::find($id);
            $this->data['product'] = $product;
        }
    }

}
