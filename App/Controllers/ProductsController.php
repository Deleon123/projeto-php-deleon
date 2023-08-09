<?php

namespace App\Controllers;

use Config\Controller\Action;
use App\Models\Product;

class ProductsController extends Action
{

    protected $data = null;

    public function index()
    {

        $product = new Product();
        $this->data = $product->readProduct();
        $this->render("Product/index.phtml", "defaultLayout2");
    }

    public function registerProduct()
    {
        $productModel = new Product();
        if (isset($_SESSION['sIs_admin'])){
            if ($_SESSION['sIs_admin'] == 'admin') {
                $this->render("Product/register.phtml", "layoutAdmin");
            } else {

                $this->data = $productModel->readProduct();
                $this->render("Product/index.phtml", "defaultLayout2");
            }
        } else {
            $this->render("Auth/login.phtml", "layoutAuth");
        }
    }

    public function exec_register(): void
    {
        $productModel = new Product();
        if ($_SESSION['sIs_admin'] == 'admin') {

            $productModel->__set("nome", $_POST['nome']);
            $productModel->__set("preco", $_POST['preco']);
            $productModel->__set("descricao", $_POST['descricao']);
            $productModel->__set("imagem", 'sorvete.png');
            if ($productModel->validate()) {
                $productModel->create();
            } else {
                $this->data['formRetorno'] = $_POST;
            }
            $this->render("Product/register.phtml", "layoutAdmin");
        } else {

            $this->data = $productModel->readProduct();
            $this->render("Product/index.phtml", "defaultLayout2");
        }
    }

    public function search(): void{
        $productModel = new Product();
        $this->data = $productModel->search($_GET['search']);
        $this->render("Product/index.phtml", "defaultLayout2");

    }
}
