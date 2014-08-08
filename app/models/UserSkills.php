<?php 

class UserSkills extends Eloquent
{ 	
	protected $table = 'users_skills';
	
	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'user_profile_id', 'created_at', 'updated_at');
	
	# Relationship method...
    public function userProfile() {
    
    	# Skills belongs to UsersProfileInfo
	    return $this->belongsTo('UserProfile');
    }
	    
}
