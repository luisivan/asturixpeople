function home() {
  loadHome();
}

function signup() {
  onRegisterButton();
}

function forgot() {
  onForgotButton();
}

function editProfile() {
  onProfileButton();
}

function changePass() {
  onPasswordButton();
}

function newIdea() {
  onNewIdeaButton();
}

function idea(id) {
  viewIdea(id);
}

function user(user) {
  viewProfile(user);
}

function category(id, page) {
  viewCategory(id, page);
}

function hot(page) {
  viewHotIdeas(page);
}

function last(page) {
  viewLastIdeas(page);
}

function approved(page) {
  viewApprovedIdeas(page);
}

function recover(email, hash) {
  recoverPassword(email, hash);
}