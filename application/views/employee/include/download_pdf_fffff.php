<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
"width=device-width, initial-scale=1.0">
    <title>Table to PDF</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <style>
        body { font-family: Arial, sans-serif;margin: 0;padding: 20px;}
        h1 {color: #333;font-size: 24px;margin-bottom: 20px; }
        p{color: #666;font-size: 16px;margin-bottom: 20px; }
        table { border-collapse: collapse;width: 100%;}
        th,td { border: 1px solid #ddd; padding: 8px;text-align: left; }
        th {background-color: #f2f2f2; }
        button {padding: 10px 20px; background-color: #007bff;color: #fff;border: none;cursor: pointer;border-radius: 5px;}
        button:hover {background-color: #0056b3; }
    </style>
</head>

<body>
    <h1>
        How to Download PDF File on
        Button Click using JavaScript
    </h1>
    <p>
        You can add your content here...
    </p>
    <table id="my-table" border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>30</td>
                <td>New York</td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>25</td>
                <td>Los Angeles</td>
            </tr>
            <tr>
                <td>Bob Johnson</td>
                <td>40</td>
                <td>Chicago</td>
            </tr>
        </tbody>
    </table>

    <button id="download-btn"style="margin-bottom:3rem;">
        Download PDF
    </button>

    <script>
    let download_button = document.getElementById("download-btn");
    let table = document.getElementById("my-table");
    download_button.addEventListener("click", function () {
    const tableData = [];const rows = table.rows;
    for(let i = 0; i < rows.length; i++){const rowData = [];const cells = rows[i].cells;for (let j = 0; j < cells.length; j++){rowData.push(cells[j].innerText);}tableData.push(rowData);}
    const docDefinition ={content: [{text: 'This is Your Employee Details',style: 'header'},
    {table:{widths: ['50%', '*', '*'],body: tableData}}],styles: {
    header:{fontSize: 18,bold: true,margin: [0, 0, 0, 10]}}};
    pdfMake.createPdf(docDefinition).open(); });
    </script>
    

</body>

</html>

