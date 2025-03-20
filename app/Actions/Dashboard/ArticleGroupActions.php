<?php
namespace App\Actions\Dashboard;

use App\Helpers\adminSettingsHelper;
use App\Repositories\Article\ArticleGroupRepo;
use App\Repositories\References\LanguageRepo;
use Illuminate\Support\Facades\App;

class ArticleGroupActions {

    protected $articleGroupRepo;
    protected $languageRepo;
    protected $activeLang;

    public function __construct()
    {
        $this->articleGroupRepo = new ArticleGroupRepo();

        // References
        $this->languageRepo = new LanguageRepo();

        // Set language globally
        $this->setLang();
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
            'activeLang' => $this->activeLang,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return $data;
    }

    public function update($group_id, $request)
    {
        
        // Process is_active
        $request['is_active'] = isset($request['is_active']) ? 1 : 0;

        // Set langage translation if exists
        $this->setLang( $request['lang'] );

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

    public function setLang( $lang=false )
    {

        if( $lang ) {
            $activeLang = $lang;
        } else {
            $activeLang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
        }
        $activeLang = strtolower($activeLang);

        $this->activeLang = $activeLang;

        App::setLocale( $activeLang );
    }

}