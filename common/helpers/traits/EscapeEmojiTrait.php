<?php
namespace common\helpers\traits;


trait EscapeEmojiTrait
{

    abstract protected function escapingAttributes();


    protected function escapeAttributes()
    {
        $test = '😊'; 
        // $test = json_encode($test);
        foreach ($this->escapingAttributes() as $attr) {
            $this->{$attr} = $test;
        }
        // var_dump($this->attributes); exit;
    }
    


    protected function unescapeAttributes()
    {
        foreach ($this->escapingAttributes() as $attr) {
            $decode = json_decode($this->{$attr});
            if (json_last_error() === 0) {
                $this->{$attr} = $decode;
            }
        }
    }


    public function beforeSave($insert)
    {
        $this->escapeAttributes();
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->unescapeAttributes();
        return parent::afterFind();
    }
}
