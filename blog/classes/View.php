<?php

class View {

    protected  $data = [];

    public function __set($key, $value) {
        $this->data[$key] = $value;
    }

    public function __get($key) {
       return $this->data[$key];
    }

    public function display($template) {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }
        include __DIR__ . '/../views/' . $template;

    }

    public function display_admin($template) {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }
        include __DIR__ . '/../admin/views/' . $template;

    }

}