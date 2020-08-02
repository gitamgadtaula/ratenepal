
    // If the user is not authenticated
    export default function ({ $auth }) {
        if (!$auth.loggedIn) {
          return redirect ('/login')
        }
      
  }
