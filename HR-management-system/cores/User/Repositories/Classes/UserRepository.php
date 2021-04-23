<?php


namespace Core\User\Repositories\Classes;

use App\Models\User;
use App\Repositories\Classes\BaseRepository;
use Core\Logging\Helpers\LoggingHelper;
use Core\User\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Spatie\Permission\Models\Role;

class UserRepository extends BaseRepository implements IUserRepository
{
    protected $_modelClass = User::class;

    public function paginate(?string $username)
    {
        $result = $this->_model->when(isset($username) && !empty($username), function($query) use($username) {
            $query->where("fullname", "like" , "%$username%");
            $query->orWhere("email", "like" , "%$username%");
            $query->orWhere("username", "like" , "%$username%");
        })
        ->orderBy('Id', 'DESC')->paginate(30);
        return $result;
    }

    public function create(array $attributes)
    {
        try {
            DB::beginTransaction();
            $obj = $this->_model->create($attributes);
            $obj->password = bcrypt($attributes["password"]);

            $obj->save();

            if (is_array($attributes["user_roles"])){
                foreach ($attributes["user_roles"] as $rid) {
                    $role = Role::findById($rid);
                    $obj->assignRole($role);
                }
            }
            DB::commit();

            return $obj;
        }catch (Exception $e){
            DB::rollBack();
            return null;
        }
    }

    public function update($id, array $attributes)
    {
        try {

            $obj = $this->findById($id);
            $obj->fullname = $attributes["fullname"];
            $obj->email = $attributes["email"];
            $obj->status = (int)$attributes["status"];
            $obj->mobile = $attributes["mobile"];
            $obj->position = $attributes["position"];
            if ($attributes["password"] != "")
            {
                if($obj->password != bcrypt($attributes["password"]))
                {
                    $user = Auth::user();

                    // logout user
                    $userToLogout = $this->findById($id);
                    $userToLogout->password = bcrypt($attributes["password"]);
                    Auth::setUser($userToLogout);

                    //Auth::logout();
                    // Auth::logoutOtherDevices($userToLogout->getAuthPassword());
                    Auth::guard($userToLogout->name)->logoutOtherDevices($attributes["password"]);
                    // set again current user
                    Auth::setUser($user);
                }
                $obj->password = bcrypt($attributes["password"]);

            }

            $obj->save();

            DB::commit();
            return $obj;
        }catch (Exception $e){
            DB::rollBack();
            return null;
        }

    }
}
