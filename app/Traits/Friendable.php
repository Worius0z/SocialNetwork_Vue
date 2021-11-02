<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Friend;

trait Friendable {
    // phuong thuc them ban dua vao status
    public function add_friend($user_requested_id) {
        if($this->id === $user_requested_id) {
			return 0;
        }
        if($this->is_friends_with($user_requested_id) === 1) {
			return "already friends";
        }
        if($this->has_pending_friend_request_sent_to($user_requested_id) === 1){
			return "already sent a friend request";
        }
        if($this->has_pending_friend_request_from($user_requested_id) === 1){
			return $this->accept_friend($user_requested_id);
		}
        $friendship = Friend::create([
            'requester' => $this->id,
            'user_requested' => $user_requested_id
        ]);
        if ($friendship) {
            return 1;
        }
        return 0;
    }

    //chap nhan add_friend
    public function accept_friend($requester) {
        if($this->has_pending_friend_request_from($requester) === 0) {
            return 0;
        }
        $friendship = Friend::where('requester', $requester)
            ->where('user_requested', $this->id)
            ->first();
        if($friendship) {
            $friendship->update([
                'status' => 1
            ]);
            return 1;
        }
        return 0;
    }

    //tu choi add_friend
    public function deny_friend($requester) {
        if($this->has_pending_friend_request_from($requester) === 0) {
            return 0;
        }
        $friendship = Friend::where('requester', $requester)
            ->where('user_requested', $this->id)
            ->first();
        if($friendship) {
            $friendship->delete();
            return 1;
        }
        return 0;
    }
    //xoa ket ban 
    public function delete_friend($user_requested_id) {
		if($this->id === $user_requested_id) {
            return 0;
        }
		if($this->is_friends_with($user_requested_id) === 1) {
            $Friendship1 = Friend::where('requester', $user_requested_id)
            ->where('user_requested', $this->id)
            ->first();
            if ($Friendship1) {
                $Friendship1->delete();
            }
            $Friendship2 = Friend::where('user_requested', $user_requested_id)
            ->where('requester', $this->id)
            ->first();
            if ($Friendship2) {
                $Friendship2->delete();
            }
        }
    }
    //tim status 
    public function friends() {
        $friends = array();
        $f1 = Friend::where('status', 1)
            ->where('requester', $this->id)
            ->get();
        foreach($f1 as $friendship):
            array_push($friends, User::find($friendship->user_requested));
        endforeach;
        $friends2 = array();
        $f2 = Friend::where('status', 1)
            ->where('user_requested', $this->id)
            ->get();
        foreach($f2 as $friendship):
            array_push($friends2, User::find($friendship->requester));
        endforeach;
        return array_merge($friends, $friends2);
    }

    // giai quyet yeu cau them ban
    public function pending_friend_requests() {
		$users = array();
		$friendships = Friend::where('status', 0)
            ->where('user_requested', $this->id)
            ->get();
		foreach($friendships as $friendship):
			array_push($users, User::find($friendship->requester));
		endforeach;
		return $users;
    }

    // thu thap id user cho vao array
    public function friends_ids() {
        return collect($this->friends())->pluck('id')->toArray();
    }

    // xet xem user khac co phai la ban chua ??
    public function is_friends_with($id) {
        if(in_array($id, $this->friends_ids())) {
            return 1;
        }else {
            return 0;
        }
    }

    // xu ly request friends id 
    public function pending_friend_requests_ids() {
		return collect($this->pending_friend_requests())->pluck('id')->toArray();
    }

    //xu ly friend requests sent
    public function pending_friend_requests_sent() {
        $users = array();
        $friendships = Friend:: where('status', 0)
            ->where('requester', $this->id)->get();
        foreach($friendships as $friendship):
            array_push($users, User::find($friendship->user_requested)->load('profile'));
        endforeach;
        return $users;
    } 

    // xu ly friend requests sent id
    public function pending_friend_requests_sent_ids() {
        return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
    }

    // form giữ các add friend requests
    public function has_pending_friend_request_from($user_id) {
        if(in_array($user_id, $this->pending_friend_requests_ids())){
            return 1;
        }else {
            return 0;
        }
    }

    public function has_pending_friend_request_sent_to($user_id) {
		if(in_array($user_id, $this->pending_friend_requests_sent_ids())) {
			return 1;
		}
		else {
			return 0;
		}
    }
}