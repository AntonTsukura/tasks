async function send_data_ajax(data, url, controller_f, URLencode, error_message){
    let json;
    if(data != null){
        if(URLencode == false || undefined){
            json = JSON.stringify(data);
        } else {
            json = encodeURIComponent((JSON.stringify(data)));
        }
    }

    let head = {
        method: "POST",
        headers:{
             'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8',
             "Access-Control-Allow-Origin" : "*", 
             "Access-Control-Allow-Credentials" : true 
        }
    };
    if(data != null)
        head["body"] = "data=" + json;

    let response = await fetch(url, head);

     if (response.ok) { 
         controller_f(await response.json());
      } else {
          console.log(error_message);
      }
}

let rows_collection = document.querySelectorAll(".row");
if(rows_collection != null){
    for(let i = 0; i < rows_collection.length; i++){
        let row = rows_collection[i];
        let row_id = row.id;
        let button_hide_el = document.getElementById("hide_"+row_id);
        button_hide_el.addEventListener("click", () => {
            let data = {action: "hide_obj", id: row_id},
            url = "php/data/action_node.php",
            controller_f = function(response_obj){
                if(response_obj.status == "success"){
                    row.remove();
                    console.log(response_obj.body);
                } else {
                    console.log(response_obj.body);
                }
                //function front end collapsing
            },
            URLencode = false,
            error_message = "Hide row error. E00013";
            send_data_ajax(data, url, controller_f, URLencode, error_message);
            
        });

        let plus_b = document.getElementById("plus_b_"+row_id);
        plus_b.addEventListener("click", () => {
            let data = {action: "add_product", id: row_id},
            url = "php/data/action_node.php",
            controller_f = function(response_obj){
                if(response_obj.status == "success"){
                    let element = row.querySelector(".quantity");
                    let value = parseInt(element.textContent);
                    let new_value = value + 1;
                    element.textContent = new_value;
                    console.log(response_obj.body);
                } else {
                    console.log(response_obj.body);
                }
                //function front end collapsing
            },
            URLencode = false,
            error_message = "Add product error. E00012";
            send_data_ajax(data, url, controller_f, URLencode, error_message);
            
        });

        let minus_b = document.getElementById("minus_b_"+row_id);
        minus_b.addEventListener("click", () => {
            let data = {action: "remove_product", id: row_id},
            url = "php/data/action_node.php",
            controller_f = function(response_obj){
                if(response_obj.status == "success"){
                    let el_text = row.querySelector(".quantity");
                    let value = parseInt(el_text.textContent);
                    if(value > 0){
                        new_value = value - 1;
                    } else {
                        new_value = 0
                    }
                    el_text.textContent = new_value;
                    console.log(response_obj.body);
                } else {
                    console.log(response_obj.body);
                }

            },
            URLencode = false,
            error_message = "Row remove error. E00011";
            send_data_ajax(data, url, controller_f, URLencode, error_message);
            
        });

    }
}