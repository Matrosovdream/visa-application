<?php
namespace App\Actions\Dashboard;

use App\Helpers\adminSettingsHelper;
use App\Repositories\Article\ArticleGroupRepo;

class ArticleGroupActions {

    private $articleGroupRepo;

    public function __construct()
    {
        $this->articleGroupRepo = new ArticleGroupRepo();
    }

    public function index()
    {

        $groups = $this->articleGroupRepo->getAll( 
            [],
            $paginate = 10 
        );

        $data = [
            'title' => 'Article groups',
            'groups' => $groups,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return $data;
    }

    public function show($group_id)
    {
        $group = $this->articleGroupRepo->getByID($group_id);

        $data = [
            'title' => 'Article group details',
            'group' => $group,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return $data;
    }

    public function update($group_id, $request)
    {
        $data = $this->articleGroupRepo->update($group_id, $request);

        return $data;
    }

    public function create()
    {
        $data = [
            'title' => 'Create new group',
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return $data;
    }

    public function store($request)
    {
        $data = $this->articleGroupRepo->create($request);
        return $data;
    }

    public function destroy($group_id)
    {
        $data = $this->articleGroupRepo->delete($group_id);

        return $data;
    }

}