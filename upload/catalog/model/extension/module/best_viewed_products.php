<?php

/**
 * Base class for job with viewed products data
 * 
 */
class ModelExtensionModuleBestViewedProducts extends Model
{
    
    public function updateViewedProduct($product_id)
    {
        if( !empty($this->getNumberViewedProduct($product_id)) )
        {
            return $this->db->query("UPDATE " . DB_PREFIX . "best_viewed_products SET number_viewed = (number_viewed + 1) WHERE product_id = '" . (int)$product_id . "'") ? true : false;
        }
        else
        {
            return $this->addViewedProduct($product_id);
        }
    }
    
    
    public function addViewedProduct($product_id)
    {
        return $this->db->query("INSERT INTO " . DB_PREFIX . "best_viewed_products (`product_id`) VALUES (" .(int)$product_id . ")") ? true : false;
    }
    
    public function getNumberViewedProduct($product_id)
    {
        $query = $this->db->query( "SELECT product_id FROM `" .DB_PREFIX. "best_viewed_products` WHERE `product_id` = '". (int)$product_id. "'" );
	return $query->rows;
    }
    
    
    public function getBestViewedProducts($limit)
    {    
        $query = $this->db->query("SELECT bvp.product_id, bvp.number_viewed FROM " . DB_PREFIX . "best_viewed_products bvp ORDER BY bvp.number_viewed DESC LIMIT " . (int)$limit);
        return $query->rows;
    }
}

