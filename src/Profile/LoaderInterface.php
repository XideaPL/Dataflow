<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Profile;

use Xidea\Component\Base\Loader\ModelLoaderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface LoaderInterface extends ModelLoaderInterface
{
    /**
     * Returns a profile by id.
     * 
     * @param int $id
     * 
     * @return \Xidea\Dataflow\ProfileInterface
     */
    function load($id);
}
