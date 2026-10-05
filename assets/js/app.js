function ajaxSearch(inputId, action, tableId)
{
    const input=document.getElementById(inputId);

    if(!input) return;

    input.addEventListener("keyup", function()
    {
        const keyword=encodeURIComponent(input.value);

        fetch(
            "index.php?page=ajax&action="+action+
            "&keyword="+keyword
        )
        .then(response => response.text())
        .then(data =>
        {
            const table=document.getElementById(tableId);

            if(table)
                table.innerHTML=data;
        });
    });
}

function confirmAction(message)
{
    return confirm(message);
}

function confirmPayment()
{
    return confirm("Confirm this rental payment?");
}
