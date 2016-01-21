<?php

/**
 * Class Variants
 */
class Variants
{

    /**
     * @var array $variant_arr - contains strings "thisSong - thisArtist - imgURL"
     */
    private $variant_arr;
    /**
     * @var int $answer - equals to index of right elemnt in array - $variant_arr
     */
    private $answer;
    private $video_ID;

    function __construct($variants_arr)
    {
        $this->create_variants($variants_arr);
    }

    /**
     * @method void create_variants - shuffles array and choose one element as right answer
     * @param $variants_arr
     */
    private function create_variants($variants_arr)
    {
        $variants = array();

        foreach ($variants_arr as $element) {
            $variants[] = $element['song'] . " - " . $element['artist'] . " - " . $element['imgURL'];
        }
        $this->answer = rand(0, count($variants) - 1);
        $this->video_ID = $variants_arr[$this->answer]['videoID'];
        $this->variant_arr = $variants;

        // shuffle($this->variant_arr);
    }

    public function __toString()
    {
        return json_encode($this->variant_arr);
    }

    /**
     * @return mixed
     */
    public function get_Variant()
    {
        return $this->variant_arr;
    }

    /**
     * @return mixed
     */
    public function get_Answer()
    {
        return $this->answer;
    }

    /**
     * @return mixed
     */
    public function getVideoID()
    {
        return $this->video_ID;
    }


}
