
var faker = window.faker;

var examples = {};
window.examples = examples;

// Basic - shows what a default table looks like
examples.basic = function () {
  var doc = new jsPDF();
  // From HTML
  doc.autoTable({ html: '.table' });
  // From Javascript
  var finalY = doc.lastAutoTable.finalY || 10;
  return doc;
}

// Multiple - shows how multiple tables can be drawn both horizontally and vertically
examples.multiple = function () {
  var doc = new jsPDF();
  doc.text('Multiple tables', 14, 20);

  doc.autoTable({ startY: 30, head: headRows(), body: bodyRows(25) });

  var pageNumber = doc.internal.getNumberOfPages();

  doc.autoTable({
    columns: [
      { dataKey: 'id', header: 'ID' },
      { dataKey: 'name', header: 'Name' },
      { dataKey: 'expenses', header: 'Sum' },
    ],
    body: bodyRows(15),
    startY: 240,
    showHead: 'firstPage',
    styles: { overflow: 'hidden' },
    margin: { right: 107 },
  });
  doc.setPage(pageNumber);
  return doc;
}

