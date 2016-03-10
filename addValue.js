
function createFormInputs(n){
    var row_i = 1;
    var i = 1;// index for names
    var r = 0;// row counter

    createFormRow (row_i);
    var row_id =  "#row_"+ row_i;

    while ( n > 0 ){

        if (r == 4){
            row_i ++;
            row_id =  "#row_"+ row_i ;
            createFormRow (row_i);
            r = 0;
        }
        createInput(row_id,i);

        i++;
        r++;
        n--;
    }
}
function createInput(idRow,i){
    $(idRow).append($("<div/>", {
        class: 'col-md-3'
    }).append($("<label/>", {
        for: 'e_'+ i,
        class: 'col-sm-12'
    }).text("Estudiante "+i+": ")).append($("<input/>", {
        name: 'e_'+ i,
        type: 'number',
        min: 0,
        class: 'col-sm-12'
    })));
}
function createFormRow(i){
    $("#marks-section-form-5").append($("<div/>", {
        class: 'row row-margin'
    }).append($("<div/>", {
        class: 'form-group ',
        id: "row_"+ i
    })));
}