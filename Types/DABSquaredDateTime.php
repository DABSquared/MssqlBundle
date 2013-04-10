<?php
/**
 * 
 *
 * @author      Ken Golovin <ken@webplanet.co.nz>
 */

namespace DABSquared\MssqlBundle\Types;

class DABSquaredDateTime extends \DateTime
{
    public function __toString()
    {
        return $this->format('Y-m-d');
    }
}

