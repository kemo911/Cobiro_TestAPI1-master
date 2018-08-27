<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use App\user_to_team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    public function addUser(Request $request){
        if ($request->name != null && $request->email != null){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return response()->json(['status'=>'User Saved Successfully']);
        }else{
            return response()->json(['status'=>'Please pass a name and email']);
        }
    }

    public function assignUserToTeam(Request $request){
        if($request->user_id != null){
            $user = User::find($request->user_id);
            if (count($user) > 0){
                if($request->team_id != null){
                    $team = Team::find($request->team_id);
                    if (count($team) > 0){
                        $find_user_team = DB::table('user_to_team')
                            ->select('*')
                            ->where('user_id',$request->user_id)
                            ->where('team_id',$request->team_id)
                            ->get();
                        if (count($find_user_team) == 0){
                            $rel = new user_to_team;
                            $rel->user_id = $request->user_id;
                            $rel->team_id = $request->team_id;
                            $rel->save();
                            return response()->json(['status' =>'The User now is part of the team']);
                        }else{
                            // if the user already part of the team
                            return response()->json(['status' =>'This user is already part of the team']);
                        }
                    }else{
                        //if the team is not found
                        return response()->json(['status' =>'Team not found']);
                    }
                }else{
                    //if the team id is null
                    return response()->json(['status' =>'You must pass team_id']);
                }
            }else{
                //if the id is not found
                return response()->json(['status' =>'This user is not found']);
            }
        }else{
            //if parameter not set
            return response()->json(['status' =>'You must pass user_id']);
        }
    }

    public function updateUser(Request $request){
        if($request->id != null){
            $user = User::find($request->id);
            if(count($user) > 0){
                if($request->name != null){
                    $user->name = $request->name;
                }

                if($request->email != null){
                    $user->email = $request->email;
                }

                if($request->role != null){
                    $user->role = $request->role;
                }

                if ($request->name == null && $request->role == null && $request->email == null){
                    return response()->json(['status' => 'You have to send at least one parameter name , role or email']);
                }else{
                    $user->update();
                    return response()->json(['status' => 'User Info Updated Successfully']);
                }
            }else{
                return response()->json(['status' => 'This ID is not Found']);
            }

        }else{
            return response()->json(['status' => 'You must pass user id']);
        }
    }

    public function setTeamOwner(Request $request){
        if ($request->user_id != null){
            $user = User::find($request->user_id);
            if (count($user) > 0){
                if ($request->team_id != null){
                    $team = Team::find($request->team_id);
                    if (count($team) > 0){
                        $team->team_owner = $user->id;
                        $team->update();
                        return response()->json(['status'=>'Team Owner Assigned']);
                    }else{
                        return response()->json(['status'=>'Team Not Found']);
                    }
                }else{
                    return response()->json(['status'=>'Please Pass a Team ID']);
                }
            }else{
                return response()->json(['status'=>'User Not Found']);
            }
        }else{
            return response()->json(['status'=>'Please Pass a User ID']);
        }
    }

    public function setUserRole(Request $request){
        if ($request->user_id != null){
            $user = User::find($request->user_id);
            if (count($user) > 0){
                if ($request->role_id != null){
                    $user->role = $request->role_id;
                    $user->update();
                    return response()->json(['status'=>'User Role Updated']);
                }else{
                    return response()->json(['status'=>'Please Pass a Role ID']);
                }
            }else{
                return response()->json(['status'=>'User Not Found']);
            }
        }else{
            return response()->json(['status'=>'Please Pass a User ID']);
        }
    }

    public function showUser(){
        if (Input::get('id') != null){
            $user = User::find(Input::get('id'));
            if(count($user) > 0){
                return response()->json(['User' => $user]);
            }else{
                return response()->json(['status' => 'User not found']);
            }
        }else{
            return response()->json(['status'=>'Please Pass a User ID']);
        }
    }

    public function deleteUser(){
        if (Input::get('id') != null){
            $user = User::find(Input::get('id'));
            if (count($user) > 0){
                $user->delete();
                return response()->json(['status'=>'User Deleted']);
            }else{
                return response()->json(['status'=>'User not found']);
            }
        }else{
            return response()->json(['status'=>'You Must Pass id Parameter']);
        }
    }


    public function getUserTeams(){
        if (Input::get('id') != null){
            $teams = DB::table("user_to_team")
                ->select('Team.team_title')
                ->join('Team','Team.id','=','user_to_team.team_id')
                ->where('user_id',Input::get('id'))
                ->get();
                if(count($teams) > 0){
                     return response()->json(['User Teams'=> $teams]);
                }else{
                    return response()->json(['status'=>'User not found']);
                }
        }else{
            return response()->json(['status'=>'Please Pass a User ID']);
        }
    }
}
