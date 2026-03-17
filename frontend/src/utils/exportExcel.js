import * as XLSX from 'xlsx';
import { saveAs } from 'file-saver';

/**
 * Export an array of objects to an Excel (.xlsx) file.
 * @param {Object[]} data         - Array of row objects
 * @param {string}   fileName     - Filename without extension
 * @param {string}   sheetName    - Sheet tab name
 * @param {string[]} [columns]    - Optional ordered column keys
 * @param {Object}   [headers]    - Optional { key: 'Display Name' } map
 */
export function exportToExcel(data, fileName = 'export', sheetName = 'Sheet1', columns = null, headers = null) {
  if (!data || data.length === 0) return;

  // Determine column order
  const cols = columns || Object.keys(data[0]);

  // Build rows with header labels
  const headerRow = cols.map(c => (headers && headers[c]) ? headers[c] : c);
  const rows = data.map(row => cols.map(c => row[c] ?? ''));

  const wsData = [headerRow, ...rows];
  const ws = XLSX.utils.aoa_to_sheet(wsData);

  // Auto column width
  const colWidths = cols.map((c, i) => ({
    wch: Math.max(
      headerRow[i].length,
      ...data.map(r => String(r[c] ?? '').length)
    ) + 2,
  }));
  ws['!cols'] = colWidths;

  // Style header row (bold) — basic
  const range = XLSX.utils.decode_range(ws['!ref']);
  for (let C = range.s.c; C <= range.e.c; C++) {
    const cellAddress = XLSX.utils.encode_cell({ r: 0, c: C });
    if (!ws[cellAddress]) continue;
    ws[cellAddress].s = { font: { bold: true }, fill: { fgColor: { rgb: '4F46E5' } } };
  }

  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, sheetName);

  const excelBuffer = XLSX.write(wb, { bookType: 'xlsx', type: 'array' });
  const blob = new Blob([excelBuffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
  saveAs(blob, `${fileName}_${new Date().toLocaleDateString('en-IN').replaceAll('/','-')}.xlsx`);
}
