<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Profile;

use Xidea\Dataflow\ProfileInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ManagerInterface
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
