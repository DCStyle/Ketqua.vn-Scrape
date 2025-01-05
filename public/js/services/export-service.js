/**
 * Export Service for handling printing and data export
 */
class ExportService {
    constructor() {
        this.printStyles = `
            @media print {
                .no-print { display: none !important; }
                .page-break { page-break-after: always; }
                table { border-collapse: collapse; width: 100%; }
                th, td { border: 1px solid #ddd; padding: 8px; }
                th { background-color: #f4f4f4 !important; }
            }
        `;
    }

    async exportToPDF(element, filename = 'lottery-results.pdf') {
        try {
            const { default: html2pdf } = await import('html2pdf.js');
            const opt = {
                margin: 10,
                filename,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, letterRendering: true },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            await html2pdf().set(opt).from(element).save();
            return true;
        } catch (error) {
            console.error('PDF export failed:', error);
            return false;
        }
    }

    exportToExcel(data, filename = 'lottery-results.xlsx') {
        try {
            const worksheet = XLSX.utils.json_to_sheet(data);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Results');
            XLSX.writeFile(workbook, filename);
            return true;
        } catch (error) {
            console.error('Excel export failed:', error);
            return false;
        }
    }

    exportToCSV(data, filename = 'lottery-results.csv') {
        try {
            const csvContent = this.convertToCSV(data);
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            link.click();
            return true;
        } catch (error) {
            console.error('CSV export failed:', error);
            return false;
        }
    }

    print(element, options = {}) {
        const printWindow = window.open('', '_blank');
        if (!printWindow) return false;

        const style = document.createElement('style');
        style.textContent = this.printStyles;

        const content = element.cloneNode(true);
        this.preparePrintContent(content, options);

        printWindow.document.head.appendChild(style);
        printWindow.document.body.appendChild(content);

        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 250);

        return true;
    }

    preparePrintContent(element, options) {
        // Remove non-printable elements
        element.querySelectorAll('.no-print').forEach(el => el.remove());

        // Add headers and footers if specified
        if (options.header) {
            const header = document.createElement('div');
            header.innerHTML = options.header;
            element.insertBefore(header, element.firstChild);
        }

        if (options.footer) {
            const footer = document.createElement('div');
            footer.innerHTML = options.footer;
            element.appendChild(footer);
        }

        // Add page breaks where specified
        if (options.pageBreaks) {
            options.pageBreaks.forEach(selector => {
                element.querySelectorAll(selector).forEach(el => {
                    el.classList.add('page-break');
                });
            });
        }
    }

    convertToCSV(data) {
        if (!data.length) return '';

        const headers = Object.keys(data[0]);
        const csvRows = [
            headers.join(','),
            ...data.map(row =>
                headers.map(header =>
                    JSON.stringify(row[header] ?? '')
                ).join(',')
            )
        ];

        return csvRows.join('\n');
    }

    async capture(elementId) {
        try {
            const element = document.getElementById(elementId);
            if (!element) throw new Error('Element not found');

            const canvas = await html2canvas(element);
            const image = canvas.toDataURL('image/png', 0.9);
            window.open(image);
            return true;
        } catch (error) {
            console.error('Screen capture failed:', error);
            return false;
        }
    }

    downloadTableAsImage(tableId, filename = 'lottery-table.png') {
        const table = document.getElementById(tableId);
        if (!table) return false;

        html2canvas(table).then(canvas => {
            const link = document.createElement('a');
            link.download = filename;
            link.href = canvas.toDataURL('image/png');
            link.click();
        });

        return true;
    }

    generateQRCode(data, element) {
        try {
            const qr = new QRCode(element, {
                text: JSON.stringify(data),
                width: 128,
                height: 128,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
            return true;
        } catch (error) {
            console.error('QR code generation failed:', error);
            return false;
        }
    }
}

const exportService = new ExportService();
export default exportService;
