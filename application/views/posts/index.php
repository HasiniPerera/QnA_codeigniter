<!DOCTYPE html>
<html>
<head>
    <title>Latest Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/5/slate/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #2C3E50;
            color: #ECF0F1;
        }

        .navbar {
            background-color: #1C82AD;
        }

        .btn-submit {
            background-color: #28A745;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .question-box {
            background-color: #FFFFFF;
            color: #000000;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .question-stats {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .question-stats span {
            margin-right: 15px;
        }

        .question-stats i {
            margin-right: 5px;
            cursor: pointer;
        }

        .question-title {
            font-weight: bold;
            font-size: 1.2em;
        }

        .question-body {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-center"><?= $title ?></h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Add Question</button>
        </div>
        <br>
        <?php foreach($posts as $post) : ?>
            <div class="question-box">
                <div class="question-title"><?php echo $post['title']; ?></div>
                <div class="question-body"><?php echo $post['body']; ?></div>
                <small class="post-date">Posted on: <?php echo $post['created_at']; ?></small>
                <div class="question-stats">
                    <span>
                        <i class="fas fa-thumbs-up" onclick="vote(<?php echo $post['id']; ?>, 'upvote')"></i>
                        <span id="upvote-count-<?php echo $post['id']; ?>"><?php echo isset($post['upvotes']) ? $post['upvotes'] : 0; ?></span>
                    </span>
                    <span>
                        <i class="fas fa-thumbs-down" onclick="vote(<?php echo $post['id']; ?>, 'downvote')"></i>
                        <span id="downvote-count-<?php echo $post['id']; ?>"><?php echo isset($post['downvotes']) ? $post['downvotes'] : 0; ?></span>
                    </span>

                </div>

                <a type="button" class="btn btn-success mt-2" href="<?php echo site_url('posts/view/'.$post['id']); ?>">Read more</a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel">Add Quesion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('posts/create'); ?>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter your question title">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea id="body" class="form-control" name="body" rows="5" placeholder="Enter your question body"></textarea>
                    </div>
                    <div class="form-group">
                         <label for="hashtags">Hashtags</label>
                         <input type="text" class="form-control" id="hashtags" name="hashtags" placeholder="Enter hashtags separated by commas">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybH7E6mxW7/7hbOOWnG4fFZv4OR2JoV9Eu1E0FxaI2aidUc6E" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93qcnD1A6AKdfSq3V0iKIxjT/tWrAnEvUl3z44lmytjnT00fTrF5i0ct9NdABr" crossorigin="anonymous"></script>
    <script>
        function vote(postId, type) {
            let url = `<?php echo site_url('posts/'); ?>${type}/${postId}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById(`${type}-count-${postId}`).innerText = data.count;
                });
        }
    </script>
</body>
</html>
