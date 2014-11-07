<?php namespace TenJava\Repository;

use DateTime;
use DB;

class EloquentRepositoryAction implements RepositoryActionInterface {

    /**
     * @param string $action The action identifier to check.
     * @return array Array of repository names which have the completed action.
     */
    public function getReposForAction($action) {
        return (RepoActions::where('action', $action)->lists('repo_name'));
    }

    /**
     * @param string $action The action identifier to check.
     * @param string $repo The repository name to check.
     * @return boolean Whether or not the action has been completed.
     */
    public function isRepoActionComplete($action, $repo) {
        return (RepoActions::where('action', $action)->where('repo_name', $repo)->count() > 0);
    }

    /**
     * @param array $repos An array of repository names.
     * @param string $action The action identifier to set.
     * @return void
     */
    public function setMultipleReposActionComplete($repos, $action) {
        $entries = [];
        // Again we use the query builder since eloquent is inefficient for this
        foreach ($repos as $repo) {
            $entries[] = ['action' => $action, 'repo_name' => $repo, 'updated_at' => new DateTime, 'created_at' => new DateTime];
        }
        DB::table('repo_actions')->insert($entries);
    }

    /**
     * @param string $action The action identifier to set.
     * @param string $repo The repository name to set the action on.
     * @return void
     */
    public function setRepoActionComplete($action, $repo) {
        RepoActions::create(['repo_name' => $repo, 'action' => $action]);
    }
}
