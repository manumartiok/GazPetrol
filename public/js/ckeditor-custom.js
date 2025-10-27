import ClassicEditorBase from '@ckeditor/ckeditor5-build-classic/src/classiceditor';
import Font from '@ckeditor/ckeditor5-font/src/font';

ClassicEditorBase.builtinPlugins.push(Font);

ClassicEditorBase.defaultConfig = {
    toolbar: [
        'heading', '|',
        'bold', 'italic', 'underline', 'strikethrough', '|',
        'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor', '|',
        'bulletedList', 'numberedList', '|',
        'alignment', '|',
        'link', 'blockQuote', 'undo', 'redo'
    ],
    fontSize: {
        options: [ '10px', '12px', '14px', '16px', '18px', '20px', '24px', '28px', '32px' ],
        supportAllValues: true
    },
    fontFamily: {
        options: [
            'default',
            'Arial, Helvetica, sans-serif',
            'Courier New, Courier, monospace',
            'Georgia, serif',
            'Lucida Sans Unicode, Lucida Grande, sans-serif',
            'Tahoma, Geneva, sans-serif',
            'Times New Roman, Times, serif',
            'Verdana, Geneva, sans-serif'
        ]
    },
    fontColor: { columns: 5 },
    fontBackgroundColor: { columns: 5 },
    language: 'es'
};

window.ClassicEditor = ClassicEditorBase;