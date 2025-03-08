<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Notes</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        /* Minimized note style */
        .note.minimized {
            height: 50px;  /* Set minimized height */
            width: 50px;   /* Set minimized width */
            padding: 10px;
            overflow: hidden; /* Prevent content overflow */
        }

        .note.minimized .note-content {
            display: none; /* Hide content when minimized */
        }

        .note.minimized .note-editor {
            display: none; /* Ensure the editor is hidden when minimized */
        }

        /* Show the note content when it's not minimized */
        .note:not(.minimized) .note-content {
            display: block;
        }
        .note-editor {
            z-index: 1000;
            pointer-events: auto;
        }


        .note {
            position: absolute;
            cursor: grab;
            width: 250px;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out, height 0.2s ease;
        }

        .note.show {
            opacity: 1;
            transform: scale(1);
        }

        .note.minimized {
            height: 50px;
            width: 50px;
            padding: 10px;
        }

        .note .note-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: move;
        }

        .add-note-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: #4CAF50;
            color: white;
            font-size: 30px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .minimize-btn, .maximize-btn, .edit-btn {
            font-size: 18px;
            cursor: pointer;
        }

        .note-editor {
            display: none;
        }

        .color-picker {
            margin-top: 10px;
        }
        .note.maximized {
            width: 500px;  /* Example of maximized width */
            height: 400px; /* Example of maximized height */
            padding: 20px;
        }


    </style>
</head>
<body class="bg-gray-100 p-10">

<!-- Add Button -->
<div class="add-note-btn" id="addNoteBtn">+</div>

<!-- Notes Container -->
<div id="notesContainer" class="relative w-full h-screen p-10">
    @foreach($notes as $note)
        <div class="bg-yellow-200 p-4 rounded-lg shadow-lg note show"
             id="note-{{ $note->id }}"
             data-id="{{ $note->id }}"
             data-reminder="{{ $note->reminder_at }}"
             style="top: {{ $note->y_position }}px; left: {{ $note->x_position }}px; background-color: {{ $note->color ?? '#FFEB3B' }};">
            <div class="note-header">
                <h1 class="text-gray-700">{{ $note->created_at->format('Y-m-d H:i') }}</h1>
                <div>
                    <button class="text-blue-500 font-bold edit-btn" data-id="{{ $note->id }}">Edit</button>
                    <button class="text-red-500 font-bold delete-note" data-id="{{ $note->id }}">X</button>
                    <button class="minimize-btn" data-id="{{ $note->id }}">_</button>
                    <button class="maximize-btn" data-id="{{ $note->id }}">[]</button>
                </div>
            </div>

            <div class="note-content">
                <p class="text-gray-700">{!! $note->content !!}</p>
            </div>

            <div class="note-editor">
                <div id="editor-{{ $note->id }}" class="bg-white h-48 border rounded p-3"></div>
                <button class="save-note-btn bg-blue-500 text-white px-4 py-2 rounded-lg mt-3">Save</button>
            </div>

            <!-- Color Picker -->
            <input type="color" class="color-picker" value="{{ $note->color ?? '#FFEB3B' }}" data-id="{{ $note->id }}">
        </div>
    @endforeach
</div>

<script>
    $(document).ready(function () {
        var editors = {}; // Store editor instances

        // Add New Note on Plus Button Click
        $("#addNoteBtn").click(function () {
            let noteHtml = `
        <div class="bg-yellow-200 p-4 rounded-lg shadow-lg note"
             style="top:100px; left:100px;">
            <div class="note-header">
                <h1 class="text-gray-700">New Note</h1>
                <div>
                    <button class="text-red-500 font-bold delete-note">X</button>
                    <button class="minimize-btn">_</button>
                </div>
            </div>
            <form class="mb-4" id="newNoteForm"> <!-- Added form id here -->
                <div id="editor-container" class="h-48 bg-white p-2 border rounded">
                    <!-- Quill Editor -->
                </div>
                <input type="hidden" class="contents">
                <input type="datetime-local" class="w-full p-3 border rounded-lg mt-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" name="reminder_time">
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-3 mt-3 rounded-lg shadow-md hover:bg-blue-600 transition">Add Note</button>
            </form>
            <!-- Color Picker -->
            <input type="color" class="color-picker" value="#FFEB3B">
        </div>`;

            let $note = $(noteHtml);
            $("#notesContainer").append($note);
            setTimeout(() => $note.addClass("show"), 10);

            // Initialize Quill editor for the new note
            let quill = new Quill($note.find("#editor-container")[0], { // Using $note.find to target the correct editor container
                theme: 'snow',
                placeholder: 'Write your note...',
            });

            // Store the editor instance for later use (e.g., saving content)
            $note.data('quill', quill);

            // Apply drag functionality to the newly added note
            addDragFunctionality();

            // Handle form submission
            $note.find("form").submit(function (e) {
                e.preventDefault(); // Prevent default form submission

                let contents = quill.root.innerHTML; // Get the content from Quill editor
                let reminderTime = $note.find('input[type="datetime-local"]').val(); // Get reminder time from the input
                let color = $note.find(".color-picker").val(); // Get color from the color picker
                let csrfToken = $("meta[name='csrf-token']").attr("content"); // Get CSRF token dynamically (ensure you have this meta tag in the head)

                // Debugging output
                console.log("Contents:", contents);
                console.log("Reminder Time:", reminderTime);
                console.log("Color:", color);

                // Send data to the server using AJAX
                $.ajax({
                    url: "/notes",
                    type: "POST",
                    data: {
                        contents: contents,
                        reminder_at: reminderTime,
                        color: color,
                        _token: csrfToken // CSRF token for security
                    },
                    success: function (response) {
                        console.log('Note saved:', response);
                        // Handle successful saving, like updating the UI with the saved note
                        $note.data("id", response.id); // Assuming the response includes the saved note's ID
                        location.reload();
                    },
                    error: function () {
                        alert("There was an error saving the note.");
                    }
                });
            });
        });

        // Handle color picker changes for both new and existing notes
        $(document).on('input', '.color-picker', function () {
            let color = $(this).val();
            let $note = $(this).closest('.note');

            // Update the background color of the note
            $note.css('background-color', color);

            // Optionally, update the color in the database (if needed)
            let noteId = $note.data("id");
            if (noteId) {
                $.post(`/notes/${noteId}/color`, { color, _token: "{{ csrf_token() }}" });
            }
        });

        // Drag functionality for all notes, including new ones
        function addDragFunctionality() {
            $(".note").draggable({
                start: function (event, ui) {
                    // Prevent drag if the user clicks inside the contenteditable area
                    if ($(event.target).is("[contenteditable='true']")) {
                        $(this).draggable("option", "disabled", true);
                    } else {
                        $(this).draggable("option", "disabled", false);
                    }
                },
                stop: function (event, ui) {
                    let $note = $(this);
                    let noteId = $note.data("id");
                    let newPosition = ui.position;

                    // Save the new position (if needed)
                    $.ajax({
                        url: `/notes/${noteId}/position`,
                        type: "POST",
                        data: {
                            x_position: newPosition.left,
                            y_position: newPosition.top,
                            _token: $("meta[name='csrf-token']").attr("content")
                        }
                    });
                }
            });
        }

        // Call addDragFunctionality to apply drag behavior to existing notes
        addDragFunctionality();

        // Delete Note functionality
        $(document).on('click', '.delete-note', function () {
            let noteId = $(this).data('id');
            $.ajax({
                url: `/notes/${noteId}`,
                type: "DELETE",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                success: function () {
                    $(`#note-${noteId}`).remove();
                }
            });
        });

        // Minimize functionality
        $(document).on('click', '.minimize-btn', function () {
            let $note = $(this).closest('.note');
            $note.toggleClass('minimized');
        });

        // Maximize functionality
        $(document).on('click', '.maximize-btn', function () {
            let $note = $(this).closest('.note');
            // Toggle between minimized and maximized classes
            if ($note.hasClass('minimized')) {
                $note.removeClass('minimized'); // Restore original size
            }
            $note.toggleClass('maximized'); // Toggle maximized state
        });


        // Edit functionality
        $(document).on('click', '.edit-btn', function () {
            let $note = $(this).closest('.note');
            let quill = $note.data('quill');

            // Hide the current content and show the editor
            $note.find('.note-content').hide();
            $note.find('.note-editor').show();

            // If Quill is not initialized yet, initialize it with the current content
            if (!quill) {
                quill = new Quill($note.find('.note-editor #editor-' + $note.data('id'))[0], {
                    theme: 'snow',
                    placeholder: 'Write your note...',
                });

                // Populate the editor with the current content of the note
                quill.root.innerHTML = $note.find('.note-content').html();

                // Store the editor instance in the note data for future use
                $note.data('quill', quill);
            } else {
                // Just set the content if Quill is already initialized
                quill.root.innerHTML = $note.find('.note-content').html();
            }
        });


        // Save Note functionality from the editor
        $(document).on('click', '.save-note-btn', function () {
            let $note = $(this).closest('.note');
            let quill = $note.data('quill');
            let contents = quill.root.innerHTML;

            // Send data to the server to save the note
            let noteId = $note.data('id');
            $.ajax({
                url: `/notes/${noteId}/update`,
                type: "POST",
                data: {
                    content: contents,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                success: function () {
                    $note.find('.note-content').html(contents).show();
                    $note.find('.note-editor').hide();
                }
            });
        });
        $(".note").on("mousedown", function (event) {
            if ($(event.target).closest(".ql-editor").length) {
                $(this).draggable("disable");
            }
        });

        $(".note").on("mouseup", function () {
            $(this).draggable("enable");
        });

    });


</script>

</body>
</html>
