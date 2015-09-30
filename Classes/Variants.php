<?php

class Variants {

    private $variant_arr;
    private $answer;

    function __construct($variants_arr) {
        $this->create_variants($variants_arr);
    }

    private function create_variants($variants_arr) {
        $variants = array();

        foreach ($variants_arr as $element) {
            $variants[] = $element['song']." - ".$element['artist']." - ".$element['imgURL'];
        }
        $this->answer=rand(0, count($variants)-1);
        $this->variant_arr=$variants;
        // shuffle($this->variant_arr);
    }

    public function __toString()
    {
        return json_encode($this->variant_arr);
    }

    public function get_Variant() {
        return $this->variant_arr;
    }

    public function get_Answer() {
        return $this->answer;
    }
}
