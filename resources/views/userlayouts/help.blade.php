@extends('userlayouts-master.user-master')
@section('title', 'How Wishare Works')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="help-container">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-question"></span>&nbsp;Help</h3>
        </div>
        <div class="panel-body">
          <b>Create a wishlist</b><br/>
          <div class="help-content">
            1. Click “Create a Wishlist” on the dashboard menu<br/>
            2. Provide wishlist title<br/>
            <div class="help-inner-content">
              a. Must be at least 2 characters<br/>
              b. May not be greater than 20 characters<br/>
            </div>
            3. Select wishlist privacy<br/>
            4. Click Create<br/>
          </div>
          <b>View Wishlist(s)</b><br/>
          <div class="help-content">
            1. Click “Profile” on the dashboard menu<br/>
            2. Click “Wishlists and Wishes”<br/>
          </div>
          <b>Update/Edit Wishlist</b><br/>
          <div class="help-content">
            1. Click “Profile” on the dashboard menu<br/>
            2. Click “Wishlists and Wishes”<br/>
            3. Click the edit icon on the wishlist you want to edit<br/>
            4. Edit wishlist title<br/>
            <div class="help-inner-content">
              a. Must be at least 2 characters<br/>
              b. May not be greater than 20 characters<br/>
            </div>
            5. Select desired wishlist privacy<br/>
            6. Click Save<br/>
          </div>
          <b>Delete Wishlist</b><br/>
          <div class="help-content">
            1. Click “Profile” on the dashboard menu<br/>
            2. Click “Wishlists and Wishes”<br/>
            3. Click the delete icon on the wishlist you want to delete<br/>
            4. Confirm or cancel deletion<br/>
          </div>
          <b>Add Wish</b><br/>
          <div class="help-content">
            1. Click “Add Wish” on the dashboard menu<br/>
            2. Select a wishlist<br/>
            3. Provide wish title(Required)<br/>
            4. Provide wish details(Optional)<br/>
            5. Provide wish alternatives(Optional)<br/>
            6. Provide wish due date(Optional)<br/>
            <div class="help-inner-content">
              a. Add the date of when you would like to get this wish<br/>
              b. Must not be before today<br/>
            </div>
            7. Provide wish image(Optional)<br/>
            <div class="help-inner-content">
              File to be uploaded must be an image file (jpeg, png, bmp, gif, or svg)<br/>
            </div>
            8. Tag friends(Optional)<br/>
            9. By default, the wish is flagged to prioritize it in wishlist. Uncheck to un-flag.<br/>
            10. Click Add<br/>
          </div>
          <b>View Wishes</b><br/>
          <div class="help-content">
            1. Event Stream
            <div class="help-inner-content">
              a. Click “Home” on the dashboard menu
            </div>
            2. Profile(Note: Displays only the five latest wishes of the user)
            <div class="help-inner-content">
              a. Click “Profile” on the dashboard menu
              b. Click “Profile Home”
            </div>
            3. In a Wishlist
            <div class="help-inner-content">
              a. Click “Profile” on the dashboard menu
              b. Click “Wishlists and Wishes”
              c. Select a wishlist
              d. Click the wishlist
            </div>
          </div>
          <b>View Specific Wish</b><br/>
          <div class="help-content">
            1. Click the wish title<br/>
          </div>
          <b>Update a Wish</b><br/>
          <div class="help-content">
            1. Event Stream<br/>
            <div class="help-inner-content">
              a. Click “Home” on the dashboard menu<br/>
              b. Click the edit icon on the wish you want to edit<br/>
              c. Select new wishlist(Optional)<br/>
              d. Edit or provide wish title. Must not be blank.<br/>
              e. Edit or provide wish details(Optional)<br/>
              f. Edit or provide wish alternatives(Optional)<br/>
              g. Edit or provide wish due date<br/>
              <div class="help-innermost-content">
                i. Add the date of when you would like to get this wish<br/>
                ii. Must not be before today<br/>
              </div>
            </div>
            2. Profile<br/>
            <div class="help-inner-content">
              a. Click “Profile” on the dashboard menu<br/>
              b. Click “Profile Home”<br/>
              c. Click the edit icon on the wish you want to edit<br/>
              d. Select new wishlist(Optional)<br/>
              e. Edit or provide wish title. Must not be blank.<br/>
              f. Edit or provide wish details(Optional)<br/>
              g. Edit or provide wish alternatives(Optional)<br/>
              h. Edit or provide wish due date<br/>
              <div class="help-innermost-content">
                i. Add the date of when you would like to get this wish<br/>
                ii. Must not be before today<br/>
                i. Edit or provide wish image(Optional)<br/>
              </div>
              File to be uploaded must be an image file (jpeg, png, bmp, gif, or svg)<br/>
              j. Tag friends(Optional)<br/>
              k. Edit flag settings.<br/>
              l. Click Update<br/>
            </div>
            3. Specific Wish<br/>
            <div class="help-inner-content">
              a. Click wish title<br/>
              b. Click the edit icon on the wish you want to edit<br/>
              c. Select new wishlist(Optional)<br/>
              d. Edit or provide wish title. Must not be blank.<br/>
              e. Edit or provide wish details(Optional)<br/>
              f. Edit or provide wish alternatives(Optional)<br/>
              g. Edit or provide wish due date<br/>
              <div class="help-innermost-content">
                i. Add the date of when you would like to get this wish<br/>
                ii. Must not be before today<br/>
              </div>
              h. Edit or provide wish image(Optional)<br/>
              <div class="help-innermost-content">
                i. File to be uploaded must be an image file (jpeg, png, bmp, gif, or svg)<br/>
              </div>
            </div>
            4. Tag friends(Optional)<br/>
            5. Edit flag settings.<br/>
            6. Click Update<br/>
          </div>
          <b>Delete a Wish</b><br/>
          <div class="help-content">
            1. Event Stream<br/>
            <div class="help-inner-content">
              a. Click “Home” on the dashboard menu<br/>
              b. Click the delete icon on the wish you want to delete<br/>
              c. Confirm or cancel deletion<br/>
            </div>
            2. Profile<br/>
            <div class="help-inner-content">
              a. Click “Profile” on the dashboard menu<br/>
              b. Click “Profile Home”<br/>
            </div>
            3. Click the delete icon on the wish you want to delete<br/>
            <div class="help-inner-content">
              a. Confirm or cancel deletion<br/>
            </div>
            4. Specific wish<br/>
            <div class="help-inner-content">
              a. Click wish title<br/>
              b. Click the delete icon<br/>
              c. Confirm or cancel deletion<br/>
            </div>
          </div>
          <b>Search a Friend/User</b><br/>
          <div class="help-content">
            1. Type in a user/friend’s name or username on the search bar on the top right corner<br/>
            2. Press Enter<br/>
          </div>
          <b>Add a User</b><br/>
          <div class="help-content">
            1. Input a name or username on the search bar on the top right  corner<br/>
            2. Press Enter<br/>
            3. Click on the user’s name<br/>
            4. Click “Add as Friend”<br/>
          </div>
          <b>Accept/Decline a Friend Request</b><br/>
          <div class="help-content">
          1. Notifications Page<br/>
            <div class="help-inner-content">
              a. Click “Notifications” on the dashboard menu<br/>
              b. Click “Friend Requests” tab<br/>
              c. Click “Accept” or “Decline”<br/>
            </div>
          </div>
          <div class="help-content">
          2. Friend Request Sender’s Profile<br/>
            <div class="help-inner-content">
              a. Click “Accept” or “Decline”<br/>
            </div>
          </div>
          <b>View Friends</b><br/>
          <div class="help-content">
          1. Click “Profile” on the dashboard menu<br/>
          2. Click “Friends”<br>
          </div>
          <b>Unfriend a Friend</b><br/>
          <div class="help-content">
            1. Search Dashboard menu<br/>
            <div class="help-inner-content">
              a. Type in a user/friend’s name or username on the search bar on the top right corner<br/>
              b. Press Enter<br/>
              c. Click on a friend’s name<br/>
              d Click “Unfriend”<br/>
            </div>
            2. Profile<br/>
            <div class="help-inner-content">
              a. Click “Profile” on the dashboard menu<br/>
              b. Click “Friends”<br/>
              c. Click on a friend’s name<br/>
              d. Click “Unfriend”<br/>
            </div>
          </div>
          <b>Send Note</b><br/>
          <div class="help-content">
            1. Click “Send Note” on the dashboard menu<br/>
            <div class="help-inner-content">
              Choose a recipient<br/>
            </div>
            2. Provide message<br/>
            <div class="help-inner-content">
              Must not be greater than 255 characters<br/>
            </div>
            3. Click “Send”<br/>
          </div>
          <b>Reply to a Note</b><br/>
          <div class="help-content">
            1. Click “Notes” on the dashboard menu<br/>
            2. Click “Notes” tab<br/>
            3. Click “Reply” on the note you want to reply to. <br/>
            4. Provide a message<br/>
            <div class="help-inner-content">
              a. Must not be greater than 255 characters<br/>
            </div>
            5. Click “Reply”<br/>
          </div>
          <b>View Sent Notes</b><br/>
          <div class="help-content">
            1. Click “Notes” on the dashboard menu<br/>
            2. Click “Outbox” tab<br/>
          </div>
          <b>Delete a Note</b><br/>
          <div class="help-content">
          1. Notes dashboard menu<br/>
            <div class="help-inner-content">
              a. Click “Notes” on the dashboard menu<br/>
              b. Click “Notes” tab<br/>
              c. Click “Delete” on the note you want to delete.<br/>
            </div>
          </div>
          <b>Send Thank You Note</b><br/>
          <div class="help-content">
            1. Click “Send Thank You Note” on the dashboard menu<br/>
            2. Choose a recipient<br/>
            3.Provide message<br/>
            <div class="help-inner-content">
              a. Must not be greater than 255 characters<br/>
            </div>
            4. Select thank you note sticker (Optional)<br/>
            5. Click “Send”<br/>
          </div>
          <b>View Sent Thank You Notes</b><br/>
          <div class="help-content">
            1. Click “Notes” on the dashboard menu
            2. Click “Outbox” tab
          </div>
          <b>View Thank You Notes</b><br/>
          <div class="help-content">
          1. Notes
            <div class="help-inner-content">
              a. Click “Notes” in the dashboard menu
              b Click the “Thank You Notes” tab
            </div>
          2. Profile
            <div class="help-inner-content">
              a. Click “Thank You Notes” in the profile navigation
            </div>
          </div>
          <b>Add/Edit/Delete Tags</b><br/>
          <div class="help-content">
          1. Event Stream	<br/>
            <div class="help-inner-content">
              a. Click “Home”<br/>
              b. Click the tag icon on the selected wish<br/>
              c. Choose a friend or friends to be tagged/untagged<br/>
              d. To untag, click the X beside on the friend’s name<br/>
              e. Click Update<br/>
            </div>
          2. Profile<br/>
            <div class="help-inner-content">
              a. Click “Profile”<br/>
              b. Click “Profile Home”<br/>
              c. Click the tag icon on the selected wish<br/>
              d. Choose a friend or friends to be tagged/untagged<br/>
              e.To untag, click the X beside on the friend’s name<br/>
              f. Click Update<br/>
            </div>
          3.Specific Wish
            <div class="help-inner-content">
              a. Click the wish title<br/>
              b. Click the tag icon on the selected wish<br/>
              c. Choose a friend or friends to be tagged/untagged<br/>
              d. To untag, click the X beside on the friend’s name<br/>
              e. Click Update<br/>
            </div>
          </div>
          <b>Favorite a Wish</b><br/>
          <div class="help-content">
            1. Click the favorite icon on the wish you want to favorite<br/>
          </div>
          <b>Unfavorite a Wish</b><br/>
          <div class="help-content">
            1. Click the favorite icon on the favorited wish<br/>
          </div>
          <b>Track</b><br/>
          <div class="help-content">
            1. Click the track icon on the wish you want to track<br/>
          </div>
          <b>Untrack a Wish</b><br/>
          <div class="help-content">
            1. Click the already tracked icon on the tracked wish you want to untrack<br/>
          </div>
          <b>Grant a Wish</b><br/>
          <div class="help-content">
            1. Click the grant icon on the wish<br/>
            2. Provide grant details (Optional)<br/>
            3. Grant image<br/>
            <div class="help-inner-content">
              File to be uploaded must be an image file (jpeg, png, bmp, gif, or svg)<br/>
            </div>
            4. Click “Grant”<br/>
          </div>
          <b>Remove Grant</b><br/>
          <div class="help-content">
            1. Click the wish title<br/>
            2. Click the delete icon<br/>
            3. Confirm or cancel deletion<br/>
          </div>
          <b>Confirm/Decline Granted Wish</b><br/>
          <div class="help-content">
            1. Click “Notifications”<br/>
            2. Click “Grant Requests” tab<br/>
            3. Click “Accept” or “Decline”<br/>
          </div>
          <b>Re-wish a wish</b><br/>
          <div class="help-content">
            1. Click the rewish icon<br/>
            2. Select a wishlist and provide details except for the wish title<br/>
            3. Click “Rewish”<br/>
          </div>
          <b>Update Profile Details</b><br/>
          <div class="help-content">
            1. Click “Settings” on the dashboard menu<br/>
            2. Click “Profile”<br/>
            3. Edit Last Name<br/>
            <div class="help-inner-content">
              a. Must be at least 2 characters<br/>
              b. May not be greater than 50 characters<br/>
              c. May only contain letters<br/>
            </div>
            4. Edit First Name<br/>
            <div class="help-inner-content">
              a. Must be at least 3 characters<br/>
              b. May not be greater than 50 characters<br/>
              c. May only contain letters<br/>
            </div>
            5. Edit Username<br/>
            <div class="help-inner-content">
              a. Must be at least 3 characters<br/>
              b. May not be greater than 15 characters<br/>
              c. May only contain letters and numbers<br/>
            </div>
            6. Edit Password<br/>
            <div class="help-inner-content">
              a. Must be at least 3 characters<br/>
              b. May not be greater than 30 characters<br/>
              c. May only contain letters and numbers<br/>
            </div>
            7. Edit Email Address<br/>
            <div class="help-inner-content">
              a. Must be a valid email address<br/>
            </div>
            8. Edit profile picture<br/>
            <div class="help-inner-content">
              a. File to be uploaded must be an image file (jpeg, png, bmp, gif, or svg)<br/>
            </div>
            9. Click “Save”<br/>
          </div>
          <b>Change Password</b><br/>
          <div class="help-content">
            1. Click “Settings” on the dashboard menu<br/>
            2. Click “Change Password”<br/>
            3. Provide current password<br/>
            4. Provide new password<br/>
            <div class="help-inner-content">
              a. Must be at least 3 characters<br/>
              b. May not be greater than 30 characters<br/>
              c. May only contain letters and numbers<br/>
            </div>
            5. Confirm new password<br/>
            6. Click “Save”<br/>
          </div>
          <b>To Deactivate an Account</b><br/>
          <div class="help-content">
            1. Email at appwishare@gmail.com
          </div>




        </div>
      </div>
    </div>
  </div>
</div>
@endsection
