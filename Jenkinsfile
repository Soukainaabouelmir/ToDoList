pipeline {
    agent any

    environment {
        IMAGE_NAME = 'soukainaabouelmir/todolist-app'
    }

    stages {
        stage('Cloner le repo') {
            steps {
                git 'https://github.com/Soukainaabouelmir/ToDoList.git'
            }
        }

        stage('Tests unitaires') {
            steps {
                echo "Ici, tu pourrais lancer des tests PHPUnit si tu en as"
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t $IMAGE_NAME .'
            }
        }

        stage('Push Docker Image') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockerhub-creds', usernameVariable: 'DOCKER_USER', passwordVariable: 'DOCKER_PASS')]) {
                    sh 'echo $DOCKER_PASS | docker login -u $DOCKER_USER --password-stdin'
                    sh 'docker push $IMAGE_NAME'
                }
            }
        }

        stage('Déploiement Kubernetes') {
            steps {
                sh 'kubectl apply -f k8s/'
            }
        }
    }
}
