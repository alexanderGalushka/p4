<?php 

class UserProfile extends Eloquent
{ 	
	protected $table = 'users_profile';
	
	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'created_at', 'updated_at');
		
	public function userSkills()
	{
	# UserProfile has many Skills
	return $this->hasMany('UserSkills');
	}
    
	/*
	public function usersJobs()
	{
	# UserProfile has many Jobs
	return $this->hasMany('Jobs');
	}
    */
    
    # Quick and dirty debugging method for dumping out the UserProfile collection
    # Used in the various demo routes
    public static function pretty_debug($usersProfile) {
	
		# If it's an array...
		if(count($userProfile) > 1) {
			foreach($userProfile as $profile) {
				echo $profile->filedOfStudy."<br>";
			}
		}
		# If it's a string...
		else {
			echo $userProfile->filedOfStudy;
		}
	}
	    
}
