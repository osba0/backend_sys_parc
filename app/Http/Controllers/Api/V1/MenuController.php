<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\SousMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class MenuController extends Controller
{
    // Listing
    public function list(){
        try{
            $q=Menu::get();
            $submenu=\DB::table('sousmenu')->join('menu','sousmenu.parent_id','=','menu.id')
                ->select('sousmenu.id','name_sous_menu','route_sous_menu', 'level_sous_menu', 'parent_id', 'etat_sous_menu')->get();
            return response([
                'success' => true,
                'menu' => $q,
                "sousmenu" => $submenu
            ]);
        }catch (\Exception $exception){
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 401);
        }
    }
    // Save Menu
    public function save(Request $request)
    {
        //if auth user do not have 'Menu-create' permission


        if(Auth::user()->cannot('create', Menu::class)) {
            return response()->json([
                'response_index' => true,
                'response_type' => 'Error',
                'response_message' => ['You are not authorized to create new menu'],
            ]);
        }
        $validator = Validator::make($request->all(), [
            'nom_menu' => 'required|unique:menu,nom_menu',
        ]);

        if ($validator->fails()) {
            $message = [];

            foreach(array_values($validator->errors()->toArray()) as $val) {
                $message[] = $val;
            }

            $res = [
                'response_index' => 'true',
                'response_type' => 'Error',
                'response_message' => $message,
            ];
            return response()->Json($res, 200);
        }

        try {
            $q = new Menu;
            $q->nom_menu = $request->input('nom_menu');
            $q->route_menu = $request->input('route_menu');
            $q->level_menu = $request->input('level_menu');
            $q->etat_menu = $request->input('etat_menu');
            $q->icone_menu = $request->input('icone_menu');

            $q->save();
            $res = [
                'response_index' => 'true',
                'response_type' => 'Success',
                'response_message' => ['New Menu Created Successfully'],
                'last_created' => Menu::orderBy('created_at', 'desc')->first()
            ];
            return response()->Json($res);

        } catch (\Exception $exception) {
            return response([
                'response_index' => 'false',
                'response_type' => 'Error',
                'response_message' => [$exception->getMessage()]
            ], 200);
        }
    }

    // Update Menu
    public function update(Request $request, $id){
        //if auth user do not have 'Menu-update' permission
        if(Auth::user()->cannot('edit', Menu::class)) {
            return response()->json([
                'response_index' => true,
                'response_type' => 'Error',
                'response_message' => ['You do not have permission to update menu'],
            ]);
        }

        try{
            $q=Menu::find($id);

            $q->update($request->all());

            return response()->Json([
                'response_index' => true,
                'response_type' => 'Success',
                'response_message' => [$q->nom_menu . ' Updated Successfully'],
                'menu_updated' => $q
            ]);
        }catch (\Exception $exception){
            response()->Json([
                'response_index' => false,
                'response_type' => 'Error',
                'response_message' => [$exception->getMessage()]
            ], 200);
        }

    }

    // Delete
    public function destroy($id)
    {
        $menu = Menu::find($id);

        //if auth user do not have 'Menu-delete' permission
        if(Auth::user()->role_type !== 'administrator' && Auth::user()->cannot('delete', Menu::class)) {
            return response()->json([
                'response_index' => true,
                'response_type' => 'Error',
                'response_message' => ['You do not have permission to delete menu'],
            ]);
        }

        try{
            $menu->delete();

            return response()->Json([
                'response_index' => true,
                'response_type' => 'Success',
                'response_message' => [$menu->nom_menu . ' Deleted Successfully'],
            ]);
        }catch (\Exception $exception){
            response()->Json([
                'response_index' => false,
                'response_type' => 'Error',
                'response_message' => [$exception->getMessage()]
            ], 200);
        }
    }

    // Save Sous Menu
    public function saveSmenu(Request $request)
    {
        //if auth user do not have 'Menu-create' permission


        if(Auth::user()->cannot('create', SousMenu::class)) {
            return response()->json([
                'response_index' => true,
                'response_type' => 'Error',
                'response_message' => ['You are not authorized to create new sub menu'],
            ]);
        }

        try {
            $q = new SousMenu;
            $q->name_sous_menu = $request->input('name_sous_menu');
            $q->route_sous_menu = $request->input('route_sous_menu');
            $q->level_sous_menu = $request->input('level_sous_menu');
            $q->parent_id = $request->input('parent_id');
            $q->etat_sous_menu = $request->input('etat_sous_menu');
            $q->icone_sous_menu = $request->input('icone_sous_menu');

            $q->save();
            return response([
                'response_index' => 'true',
                'response_type' => 'Success',
                'response_message' => ['New Sub Menu Created Successfully'],
                'last_created' => SousMenu::orderBy('created_at', 'desc')->first()
            ]);
        } catch (\Exception $exception) {
            return response([
                'response_index' => 'false',
                'response_type' => 'Error',
                'response_message' => [$exception->getMessage()]
            ], 200);
        }
    }

    // Update SousMenu
    public function updateSmenu(Request $request, $id){
        //if auth user do not have 'SubMenu-update' permission
        if(Auth::user()->cannot('edit', SousMenu::class)) {
            return response()->json([
                'response_index' => true,
                'response_type' => 'Error',
                'response_message' => ['You do not have permission to update sub menu'],
            ]);
        }
        try{
            $q=SousMenu::find($id);

            $q->update($request->all());

            return response([
                'response_index' => true,
                'response_type' => 'Success',
                'response_message' => [$q->name_sous_menu . ' Updated Successfully'],
                'submenu_updated' => $q
            ]);
        }catch (\Exception $exception){
            response()->Json([
                'response_index' => false,
                'response_type' => 'Error',
                'response_message' => [$exception->getMessage()]
            ], 200);
        }

    }

    // Delete Sous menu
    public function destroySmenu($id)
    {
        $submenu = SousMenu::find($id);
        //if auth user do not have 'Menu-delete' permission
        if(Auth::user()->role_type !== 'administrator' && Auth::user()->cannot('delete', SousMenu::class)) {
            return response()->json([
                'response_index' => true,
                'response_type' => 'Error',
                'response_message' => ['You do not have permission to delete menu'],
            ]);
        }
        try{
            $submenu->delete();

            return response([
                'response_index' => true,
                'response_type' => 'Success',
                'response_message' => [$submenu->name_sous_menu . ' Deleted Successfully'],
            ]);
        }catch (\Exception $exception){
            return response([
                'response_index' => false,
                'response_type' => 'Error',
                'response_message' => [$exception->getMessage()]
            ], 200);
        }
    }
}
