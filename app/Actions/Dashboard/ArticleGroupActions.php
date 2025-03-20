<?php
namespace App\Actions\Dashboard;

use App\Helpers\adminSettingsHelper;
use App\Repositories\Article\ArticleGroupRepo;
use App\Repositories\References\LanguageRepo;

class ArticleGroupActions {

    protected $articleGroupRepo;
    protected $languageRepo;

    public function __construct()
    {
        $this->articleGroupRepo = new ArticleGroupRepo();

        // References
        $this->languageRepo = new LanguageRepo();
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
            'languages' => $this->languageRepo->getAll(['is_active' => 1]),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return $data;
    }

    public function update($group_id, $request)
    {
        
        // Process is_active
        $request['is_active'] = isset($request['is_active']) ? 1 : 0;

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