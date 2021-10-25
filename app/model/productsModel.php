<?php

class productsModel
{
    private $DBConnect;

    public function __construct()
    {
        $conn = new DBConnect();
        $this->DBConnect = $conn->connect();
    }

    public function addProduct($product)
    {
        $sql = 'insert into products(name,category,price,quantity,information) value (?,?,?,?,?)';

        $stmt = $this->DBConnect->prepare($sql);

        $stmt->bindParam(1, $product['name']);
        $stmt->bindParam(2, $product['category']);
        $stmt->bindParam(3, $product['price']);
        $stmt->bindParam(4, $product['quantity']);
        $stmt->bindParam(5, $product['information']);

        $stmt->execute();
    }

    public function search($key)
    {
        $sql = "select * from products where name like N'%$key%' or name like N'$key'";
        $stmt = $this->DBConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function editProduct($product)
    {
        $sql = 'update products set name=?, information=?, quantity=?, price=?, category=? where productCode=?';
        $stmt = $this->DBConnect->prepare($sql);
        $stmt->bindParam(1, $product['name']);
        $stmt->bindParam(2, $product['information']);
        $stmt->bindParam(3, $product['quantity']);
        $stmt->bindParam(4, $product['price']);
        $stmt->bindParam(5, $product['category']);
        $stmt->bindParam(6, $product['id']);
        $stmt->execute();
    }

    public function selectAllProducts()
    {
        $sql = 'select * from products';
        $stmt = $this->DBConnect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function deleteProduct($id)
    {
        $sql = 'delete from products where productCode=:id';
        $stmt = $this->DBConnect->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getById($id)
    {
        $sql = 'select * from products where productCode=?';
        $stmt = $this->DBConnect->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetch();
    }

}
