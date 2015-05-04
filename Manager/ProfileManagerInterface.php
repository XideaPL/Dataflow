<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Manager;

use Xidea\Component\Dataflow\Model\ProfileInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ProfileManagerInterface
{
    /**
     * Saves a profile.
     * 
     * @param ProfileInterface $profile
     */
    function save(ProfileInterface $profile);

    /**
     * Updates a profile.
     * 
     * @param ProfileInterface $profile
     */
    function update(ProfileInterface $profile);

    /**
     * Deletes a profile.
     * 
     * @param ProfileInterface $profile
     */
    function delete(ProfileInterface $profile);
}
