<?php

class FeedbackProxy extends DatabaseAware {

    private function _escapeParams(&$params) {
        foreach ($params as $key => &$value) {
            if (is_array($value)) {
                $this->_escapeParams($value);
            }
            $value = $this->database->escape($value);
        }
    }

    public function sendFeedback($params = null) {
        $this->_escapeParams($params);
    }

}

