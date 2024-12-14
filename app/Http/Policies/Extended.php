<?php 

namespace App\Http\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class Extended extends Basic
{
    public function configure()
    {
        parent::configure();
        
        $this->addDirective(Directive::STYLE, 'fonts.googleapis.com');
        $this->addDirective(Directive::DEFAULT, 'fonts.gstatic.com');
        $this->addDirective(Directive::DEFAULT, 'www.youtube.com');
    }
}