<?php 

    class TagsCategoriesHelper {

        protected $type;

        public function getTags($attrObject,$targetPageURL){
            $this->type = 'tags';
            $string = implode(', ',$this->getArrayOfTextLinks($attrObject, $targetPageURL));
            return rtrim($string,', ');
        }

        public function getCategories($attrObject,$targetPageURL){
            $this->type = 'category';
            $string = implode(', ',$this->getArrayOfTextLinks($attrObject, $targetPageURL));
            return rtrim($string,', ');
        }

        protected function getArrayOfTextLinks($attrObject,$targetPageURL){
            $arr = array();
            if($attrObject){
                if($attrObject instanceof SelectAttributeTypeOptionList){
                    foreach($attrObject as $objList){
                        $obj = $objList->getSelectAttributeOptionValue();
                        $arr[] = '<a href="'.$targetPageURL.'?'.http_build_query(array($this->type=>$obj)).'" title="See other posts in this '.$this->type.'">'.$this->spaces($obj).'</a>';
                    }
                }elseif($attrObject instanceof SelectAttributeTypeOption){
                    $obj = $attrObject->getSelectAttributeOptionValue();
                    $arr[] = '<a href="'.$targetPageURL.'?'.http_build_query(array($this->type=>$obj)).'" title="See other posts in this '.$this->type.'">'.$this->spaces($obj).'</a>';
                }
            }

            return !empty($arr) ? $arr : array('None');
        }

        public function spaces($v){ return ucwords(str_replace(array('-', '/'), ' ', $v)); }
    }

?>
