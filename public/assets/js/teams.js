var cached_names = [];

function generateName() {
  if (cached_names.length > 0) {
    $('#name').val(cached_names.pop());
    return;
  }
  $.ajax('/teams/generatename/15').done(function(response) {
    cached_names = response;
    generateName();
  });
}
