<?php

/* output a rectangle

*/

class XML_SvgToPDF_Rect  extends XML_SvgToPDF_Base {
    function writePDF(&$pdf,$data) {
        $x =  $this->x   + @$this->xx;
        $y =  $this->y  + @$this->yy;
        
        
        if(isset($this->style['stroke-width']))
        	$pdf->setLineWidth($this->style['stroke-width']/ 3.543307); 
        $f = $this->toColor($this->style['fill']);
        if ($f) {
            $pdf->setFillColor($f[0],$f[1],$f[2]);
        }
        
        $l = $this->toColor(@$this->style['stroke']);
        if ($l) {
            $pdf->setDrawColor($l[0],$l[1],$l[2]);
        }
        // no fill, no line = dont draw...
        if (!$l && !$f) {
            return;
        }
        XML_SvgToPDF::debug("RECT:" .($x/ 3.543307).',' .($y/ 3.543307). ','
             .($this->width/ 3.543307).',' . ($this->height/ 3.543307));
        $pdf->rect($x/ 3.543307,$y/ 3.543307,
            $this->width/ 3.543307,$this->height/ 3.543307,($l ? 'D' : ''). ($f ? 'F' : ''));
    
    
    
    }


    function toColor($color) {
        if (!$color || ($color == 'none')) {
            return false;
        }
        return array(
            hexdec(substr($color,1,2)),
            hexdec(substr($color,3,2)),
            hexdec(substr($color,5,2)));
        
    }


}