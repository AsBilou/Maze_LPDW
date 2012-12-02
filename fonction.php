<?php
    function checkSize($line,$column){
        if((($column*$line)<=14161)&&(($column*$line)>=100)){
            return true;
        }else{
            return false;
        }
    }
?>