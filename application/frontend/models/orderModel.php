<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class orderModel extends Data {

	public $searchCriteria;
	function __construct() 
	{
        parent::__construct();
        $this->tbl = 'order_master';
    }
}