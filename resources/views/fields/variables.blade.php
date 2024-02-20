<script>

let filamentSpatieLaravelDatabaseMailTemplateInsertVariable = (function () {

    // from https://stackoverflow.com/questions/5525071/how-to-wait-until-an-element-exists
    function waitForElm(selector) {
        return new Promise(resolve => {
            if (document.querySelector(selector)) {
                return resolve(document.querySelector(selector));
            }

            const observer = new MutationObserver(mutations => {
                if (document.querySelector(selector)) {
                    observer.disconnect();
                    resolve(document.querySelector(selector));
                }
            });

            // If you get "parameter 1 is not of type 'Node'" error, see https://stackoverflow.com/a/77855838/492336
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        });
    }

    // from https://stackoverflow.com/questions/11076975/how-to-insert-text-into-the-textarea-at-the-current-cursor-position
    function insertAtCursor(myField, myValue) {
        //IE support
        if (document.selection) {
            myField.focus();
            sel = document.selection.createRange();
            sel.text = myValue;
        }
        //MOZILLA and others
        else if (myField.selectionStart || myField.selectionStart == '0') {
            var startPos = myField.selectionStart;
            var endPos = myField.selectionEnd;
            myField.value = myField.value.substring(0, startPos)
                + myValue
                + myField.value.substring(endPos, myField.value.length);
        } else {
            myField.value += myValue;
        }
    }

    var insertInLastFocusedEditor = undefined;

    // Watch for subject editor focus
    let input = document.querySelector('[id="data.subject"]');
    input.addEventListener('focus', function() {
        insertInLastFocusedEditor = function (str) {
            insertAtCursor(input, str);
        };
    });

    // Watch for plain-text editor focus
    waitForElm('.EasyMDEContainer').then((elm) => {
        let cm = elm.getElementsByClassName('CodeMirror')[0].CodeMirror;
        cm.on('focus', function() {
            insertInLastFocusedEditor = function (str) {
                cm.replaceSelection(str);
                cm.focus();
            };
        });
    });

    // Watch for HTML editor focus
    document.addEventListener("trix-focus", (event) => insertInLastFocusedEditor = (str) => event.target.editor.insertString(str));

    return (key) => insertInLastFocusedEditor("\{\{ " + key + " \}\}");
})();

</script>

<span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">{{ __('database-mail-templates::database-mail-templates.field.variables') }}</span>
<p class="fi-fo-field-wrp-hint-label fi-color-gray text-gray-500 text-sm">
    {{ __('database-mail-templates::database-mail-templates.hint.variables') }}
</p>

<ul>
    @foreach ($getRecord()->getVariables() as $variable)
        <li class="my-2">
            <a class="min-w-[theme(spacing.8)] cursor-pointer inline-block rounded-lg p-2 text-sm font-semibold transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 bg-gray-50 text-primary-600 dark:bg-white/5 dark:text-primary-400" type="button" onclick="javascript:filamentSpatieLaravelDatabaseMailTemplateInsertVariable('{{ $variable }}')">
                &#123;&#123; {{ $variable }} &#125;&#125;
            </a>
        </li>
    @endforeach
</ul>
