<?php

class FeedbackProxy extends DatabaseAware {

    public function sendFeedback($params = null) {
        $this->escapeParams($params);
    }

}

