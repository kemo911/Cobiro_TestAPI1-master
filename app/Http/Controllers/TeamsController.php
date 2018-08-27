<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TeamsController extends Controller
{
    public function addTeam(Request $request){
        if ($request->title != null){
            $team = new Team;
            $team->team_title = $request->title;
            $team->save();
            return response()->json(['status'=>'Team Saved Successfully']);
        }else{
            return response()->json(['status'=>'Please Pass a Team Title']);
        }
    }

    public function updateTeam(Request $request){

        if($request->id != null){
            $team = Team::find($request->id);
            if(count($team) > 0){
                if($request->title != null){
                    $team->team_title = $request->title;
                }

                if($request->owner != null){
                    $team->team_owner = $request->owner;
                }

                if ($request->title == null && $request->owner == null){
                    return response()->json(['status' => 'You have to send at least one parameter title OR owner']);
                }else{
                    $team->update();
                    return response()->json(['status' => 'Team Info Updated Successfully']);
                }
            }else{
                return response()->json(['status' => 'This ID is not Found']);
            }

        }else{
            return response()->json(['status' => 'You must send id parameter in the URL']);
        }
    }

    public function showTeam(){
        if (Input::get('id') != null){
            $team = Team::find(Input::get('id'));
            if (count($team) > 0){
                return response()->json(['Team_Info' => $team]);
            }else{
                return response()->json(['status'=>'Team not found']);
            }
        }else{
            return response()->json(['status'=>'You Must Pass id Parameter']);
        }
    }

    public function deleteTeam(){
        if (Input::get('id') != null){
            $team = Team::find(Input::get('id'));
            if (count($team) > 0){
                $team->delete();
                return response()->json(['status'=>'Team Deleted']);
            }else{
                return response()->json(['status'=>'Team not found']);
            }
        }else{
            return response()->json(['status'=>'You Must Pass id Parameter']);
        }
    }

    public function getTeams(){
        return response()->json(['Teams' => Team::all()]);
    }

    public function getTeamUsers(){
        if (Input::get('id') != null){
            $team = DB::table('user_to_team')
                ->select('User.name',"User.role")
                ->join('User','User.id','=','user_to_team.user_id')
                ->where('user_to_team.team_id',Input::get('id'))
                ->get();

            if (count($team) > 0){
                return response()->json(['Users'=>$team]);
            }else{
                return response()->json(['status'=>'No Users Found for this Team']);
            }
        }else{
            return response()->json(['status'=>'You Must Pass id Parameter']);
        }
    }
}
