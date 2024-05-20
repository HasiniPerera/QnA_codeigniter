<!DOCTYPE html>
<html>
<head>
    <title><?php echo $post['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/5/slate/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .question-box, .answer-box {
            background-color: #FFFFFF;
            color: #000000;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .question-stats, .answer-stats {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        .question-stats span, .answer-stats span {
            margin-right: 15px;
        }
        .question-stats i, .answer-stats i {
            margin-right: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <h4><?php echo $post['title']; ?></h4>
        <div class="question-box">
            <small>Posted on: <?php echo $post['created_at']; ?></small><br>
            <small class="post-by">Posted by: <?php echo $post['fname']; ?></small><br><br>
            <?php echo $post['body']; ?>
            <div class="question-stats">
                <span>
                    <i class="bi bi-hand-thumbs-up" onclick="voteQuestion(<?php echo $post['id']; ?>, 'upvote')"></i>
                    <span id="question-upvote-count-<?php echo $post['id']; ?>"><?php echo isset($post['upvotes']) ? $post['upvotes'] : 0; ?></span>
                </span>
                <span>
                    <i class="bi bi-hand-thumbs-down" onclick="voteQuestion(<?php echo $post['id']; ?>, 'downvote')"></i>
                    <span id="question-downvote-count-<?php echo $post['id']; ?>"><?php echo isset($post['downvotes']) ? $post['downvotes'] : 0; ?></span>
                </span>
            </div>
        </div>
        <hr>
        <h4>Answers</h4>
        <div>
            <?php if($answers) : ?>
                <?php foreach($answers as $answer) : ?>
                    <div class="answer-box">
                        <small><?php echo $answer['body']; ?> </small><br>
                        <small>Posted on: <?php echo isset($answer['created_at']) ? $answer['created_at'] : 'Date not available'; ?></small><br>
                        <div class="answer-stats">
                            <span>
                                <i class="bi bi-hand-thumbs-up" onclick="voteAnswer(<?php echo $answer['id']; ?>, 'upvotes')"></i>
                                <span id="answer-upvotes-count-<?php echo $answer['id']; ?>"><?php echo isset($answer['upvotes']) ? $answer['upvotes'] : 0; ?></span>
                            </span>
                            <span>
                                <i class="bi bi-hand-thumbs-down" onclick="voteAnswer(<?php echo $answer['id']; ?>, 'downvotes')"></i>
                                <span id="answer-downvotes-count-<?php echo $answer['id']; ?>"><?php echo isset($answer['downvotes']) ? $answer['downvotes'] : 0; ?></span>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?><br>
            <?php else : ?>
                <p>No answers to display</p>
            <?php endif; ?>
        </div><br>

        <h4>Add Answer</h4>
        <?php echo validation_errors(); ?>
        <?php echo form_open('Answers/create/'.$post['id']); ?>
        <div class="form-group">
            <textarea class="form-control" name="answer" ></textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>"><br>
        <button class="btn btn-success" type="submit">Post Answer</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybH7E6mxW7/7hbOOWnG4fFZv4OR2JoV9Eu1E0FxaI2aidUc6E" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93qcnD1A6AKdfSq3V0iKIxjT/tWrAnEvUl3z44lmytjnT00fTrF5i0ct9NdABr" crossorigin="anonymous"></script>
    <script>
        function voteQuestion(postId, type) {
            let url = `<?php echo site_url('posts/vote_question/'); ?>${postId}/${type}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById(`question-${type}-count-${postId}`).innerText = data.count;
                });
        }

        function voteAnswer(answerId, type) {
            let url = `<?php echo site_url('posts/vote_answer/'); ?>${answerId}/${type}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById(`answer-${type}-count-${answerId}`).innerText = data.count;
                });
        }
    </script>
</body>
</html>
