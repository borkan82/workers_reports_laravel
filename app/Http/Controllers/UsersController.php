<?php
namespace App\Http\Controllers;
use App\Repository\UsersRepo as repo;
use App\Validation\UsersValidator;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
class UsersController extends Controller
{
    private $repo;
 
    public function __construct(repo $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {

        $code = $request->input('id');

        $userData = $this->repo->getUserData($code);
//return response()->json($userData->position);
        if (empty($userData) && $userData->role !== "A" && $userData->role !== "S") {
            return response("Permision denied");
        }

        $a_date = Date("Y-m-h");
        $godina = Date("Y");
        $mjesec = Date("m", strtotime($a_date . " - 1 month"));
        $defaultDateFrom = $godina . "-" . $mjesec . "-01";
        $daysNum = date("Y-m-t", strtotime($a_date));
        $defaultDateTo = $godina . "-" . $mjesec . "-31";

        $datum = Date("Y-m-d");
        $monthLess = date('F', strtotime($a_date . " - 1 month"));

        $userslist = $this->repo->UsersList();

        $userAdmin = false;
        $userAdminFlag = 0;
        if ($userData->role == "A" || $userData->role == "S") {
            $userAdmin = true;
            $userAdminFlag = 1;
        }
        $userTeam = $userData->team;

        return view('users', ['users'=>$userslist, 'userData'=>$userData, 'userAdmin'=>$userAdminFlag]);
    }
 
    public function edit($id=NULL)
    {
        return View('admin.index')->with(['data' => $this->repo->usersOfId($id)]);
    }
 
    public function editUser()
    {
        $all = Input::all();
        $validate = UserValidator::validate($all);
        if (!$validate->passes()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $Id = $this->repo->usersOfId($all['id']);
        if (!is_null($Id)) {
            $this->repo->update($Id, $all);
            Session::flash('msg', 'edit success');
        } else {
            $this->repo->create($this->repo->perpare_data($all));
            Session::flash('msg', 'add success');
        }
        return redirect()->back();
    }
 
    public function retrieve()
    {
        return View('admin.index')->with(['Data' => $this->repo->retrieve()]);
    }
 
    public function delete()
    {
        $id = Input::get('id');
        $data = $this->repo->usersOfId($id);
        if (!is_null($data)) {
            $this->repo->delete($data);
            Session::flash('msg', 'operation Success');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('operationFails');
        }
    }
}
?>