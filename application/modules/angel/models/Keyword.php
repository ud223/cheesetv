<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Keyword
 *
 * @author vince
 */
class Angel_Model_Keyword extends Angel_Model_AbstractModel {
    protected $_document_class = '\Documents\Keyword';

    public function addKeyword($keycode, $attributes) {
        $data = array("keycode" => $keycode, "attributes" => $attributes);
        $result = $this->add($data);
        
        return $result;
    }

    public function saveKeyword($id, $keycode, $attributes) {
        $data = array("keycode" => $keycode, "attributes" => $attributes);
        $result = $this->save($id, $data);
        
        return $result;
    }

    public function getRoot() {
        $query = $this->_dm->createQueryBuilder($this->_document_class)->find();//->field('keycode')->in(array('aa'));//->equals(new MongoRegex("/aa/i"));//findby({keycode: {$in:["aa", "bb"]}})->sort('created_at', -1);

        $result = $query
                ->getQuery()
                ->execute();

        return $result;
    }
    
    /**
     * 根据id获取Keyword document
     * 
     * @param string $id
     * @return mix - when the user found, return the user document
     */
    public function getById($id) {
        $result = false;
        $keyword = $this->_dm->createQueryBuilder($this->_document_class)
                ->field('id')->equals($id)
                ->getQuery()
                ->getSingleResult();

        if (!empty($keyword)) {
            $result = $keyword;
        }

        return $result;
    }
}
