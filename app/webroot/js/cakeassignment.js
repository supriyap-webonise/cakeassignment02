//ajax call for getting project list according to selected category
function getprojects()
    {
        $.ajax({
                    url: "/projects/categoryprojectlist/"+$('#contract_id').val(),
                    type: "post"
                }).done(function(response) {
                        $('#projecttable').html(response);
                    });
    }
//load all employees related to particular technology

function loadUser()
    {
	var tech_id = $('#AllocateTechnologyId').val();
	var project_id = $('#AllocateProjectId').val();
	$.ajax({
              url: "/projects/technologyemployee/"+tech_id+"/"+project_id,
              type: "post"
            }).done(function(response) {
                  $('#tech_employee').replaceWith(response);
                    });
	}

//allocate user to particular project
function allocate(work_load,user_id)
{
    $("#allocation_unit_"+user_id).removeAttr("disabled");
    $(".allocations").change(function(){
                        var work_load = $(this).val();
                        var tech_id = $('#AllocateTechnologyId').val();
                        var project_id = $('#AllocateProjectId').val();
                        $.ajax({
                                    url: "/projects/allocateToProject/"+project_id+"/"+user_id+"/"+work_load,
                                    type: "post"
                                }).done(function(response) {
                                        loadUser();
                                    });
                    });
}

//unallocate user to particular project
function unalloate(projectemployee,empid,techid,projectid)
{
    $.ajax({
                url: "/projects/unallocate/"+projectemployee+"/"+empid+"/"+techid+"/"+projectid,
                type: "post"
            }).done(function(response) {
                    loadUser();
                });
}