<?php
namespace App\View\Helper;

use Cake\View\Helper;

class FootnoteHelper extends Helper
{
    public $helpers = ['Text'];
    
    protected $items = [];
    protected $counter = 1;
    
    public function check($test) 
    {
      if (strcasecmp($test, '') == 0) {
        return '';
      } else if (strcasecmp($test, 'pass') == 0) {
        return '<span class="glyphicon glyphicon-ok" style="color:green;" aria-hidden="true" title="Passed"></span>';
      } else {
        $key = array_search($test, $this->items);
        if ($key) {
          $noteid = $key;
        } else {
          $noteid = $this->counter;
          $this->items[$noteid] = $test;
          $this->counter++;
        }
        return $this->Text->insert(
            '<span class="badge" data-toggle="tooltip" title=":title">:badge</span>',
            ['badge'=>$noteid,'title'=>$test]);
      }
    }

    public function footnote_list()
    {
      if (!$this->items) {
        return '<p>All good!</p>';
      }
      $output = '<ol>';
      foreach ($this->items as $key => $value) {
        $output .= $this->Text->insert('<li>:title</li>',['title'=>$value]);
        }
      $output .= '</ol>';
      return $output;
    }


}
