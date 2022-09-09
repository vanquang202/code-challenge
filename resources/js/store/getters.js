export  default  {
    getUser( state ) {
        if(state.user == null) return false;
        return state.user.name;
    },
    getToken( state ) {
        if(state.token == null) return false;
        return state.token;
    }
}
