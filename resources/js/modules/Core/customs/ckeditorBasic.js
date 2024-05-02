import { ClassicEditor as ClassicEditorBase } from '@ckeditor/ckeditor5-editor-classic';
import { Essentials } from '@ckeditor/ckeditor5-essentials';
// import { CKFinderUploadAdapter } from '@ckeditor/ckeditor5-adapter-ckfinder';
import { Autoformat } from '@ckeditor/ckeditor5-autoformat';
import { Bold, Italic } from '@ckeditor/ckeditor5-basic-styles';
import { BlockQuote } from '@ckeditor/ckeditor5-block-quote';
// import { CKBox } from '@ckeditor/ckeditor5-ckbox';
// import { CKFinder } from '@ckeditor/ckeditor5-ckfinder';
// import { EasyImage } from '@ckeditor/ckeditor5-easy-image';
import { Heading } from '@ckeditor/ckeditor5-heading';
import { Image, ImageCaption, ImageStyle, ImageToolbar, ImageUpload, PictureEditing, ImageResize, ImageSizeAttributes } from '@ckeditor/ckeditor5-image';
import { Indent } from '@ckeditor/ckeditor5-indent';
import { Link } from '@ckeditor/ckeditor5-link';
import { List } from '@ckeditor/ckeditor5-list';
import { MediaEmbed } from '@ckeditor/ckeditor5-media-embed';
import { Paragraph } from '@ckeditor/ckeditor5-paragraph';
import { PasteFromOffice } from '@ckeditor/ckeditor5-paste-from-office';
import { Table, TableToolbar } from '@ckeditor/ckeditor5-table';
import { TextTransformation } from '@ckeditor/ckeditor5-typing';
// import { CloudServices } from '@ckeditor/ckeditor5-cloud-services';
import { SimpleUploadAdapter } from '@ckeditor/ckeditor5-upload';

import ENV from "../config/env";

export default class ClassicEditor extends ClassicEditorBase {}

ClassicEditor.builtinPlugins = [
    Essentials,
    // CKFinderUploadAdapter,
    Autoformat,
    Bold,
    Italic,
    BlockQuote,
    // CKBox,
    // CKFinder,
    // EasyImage,
    Heading,
    Image,
    ImageResize,
    ImageSizeAttributes,
    ImageCaption, 
    ImageStyle, 
    ImageToolbar, 
    ImageUpload, 
    PictureEditing,
    Indent,
    Link,
    List,
    MediaEmbed,
    Paragraph,
    PasteFromOffice,
    Table,
    TableToolbar,
    TextTransformation,
    // CloudServices,
    SimpleUploadAdapter
];

const urlUpload = ENV.API_URL + "upload-files/ckeditor";

ClassicEditor.defaultConfig = {
    toolbar: {
        items: [
            'undo',
            'redo',
            '|',
            'heading',
            '|',
            'bold',
            'italic',
            '|',
            'link',
            'imageUpload',
            // 'CKFinder',
            'insertTable',
            'blockQuote',
            'mediaEmbed',
            'numberedList',
            'bulletedList',
            'outdent',
            'indent'
        ]
    },
    simpleUpload: {
        uploadUrl: urlUpload,
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            Authorization: 'Bearer '
        }
    },
    image: {
        toolbar: [
            'imageStyle:inline', 'imageStyle:wrapText', 'imageStyle:breakText', '|',
            'toggleImageCaption', 'imageTextAlternative'
        ]
    },
    language: 'en'
};
