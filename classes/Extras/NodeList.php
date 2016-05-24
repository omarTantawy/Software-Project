<?php

/**
 * @author yehia
 * @copyright 2010
 */

abstract class NodeList{
    
    static public function setIndents(&$categories){
        $right = array();
        foreach($categories as $key => $record){
            if(count($right) > 0){
                for($i = count($right)-1;$i>=0;$i--){
                    if($right[$i]<$record['rgt'])
                        array_pop($right);
                }
            }
            $categories[$key]['indent'] = count($right);
            $right[] = $record['rgt'];
        }
    }
    static public function applyIndents(&$categories){
        foreach($categories as $key => $record){
			$categories[$key]['name'] = '&nbsp;'.$categories[$key]['name'];
			for($i = 0; $i < $record['indent']; $i++){
   				$categories[$key]['name'] = '&raquo;'.$categories[$key]['name'];
			 }
			for($i = 0; $i < $record['indent']; $i++){
   				$categories[$key]['name'] = '&nbsp;&nbsp;&nbsp;&nbsp;'.$categories[$key]['name'];
			 }
		 }
    }
    static public function rebuildTree($parent, $left) {  
       $right = $left+1;
       $result = Database::query('SELECT * FROM mall_categories WHERE parentId = "'.$parent.'"');  
       while ($row = mysql_fetch_array($result)) {  
           $right = NodeList::rebuildTree($row['id'], $right);  
       } 
       Database::query('UPDATE mall_categories SET
            lft="'.$left.'", rgt="'.$right.'" WHERE id="'.$parent.'"'
       );  
       return $right+1;  
    }
}