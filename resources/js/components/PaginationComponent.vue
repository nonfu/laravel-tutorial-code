<style scoped>
    .container .row{
        margin-top: 10px;
    }
</style>

<template>
    <div class="container">
        <div class="row">
            <ul class="posts list-group">
                <li v-for="post in paginator.data" class="list-group-item">
                    {{ post.title }}
                </li>
            </ul>
        </div>

        <div class="row text-center">
            <ul class="pagination" role="navigation" v-if="paginator">

                <li class="page-item" v-if="paginator.prev_page_url">
                    <a class="page-link" v-bind:href="paginator.prev_page_url" rel="prev">&lsaquo;</a>
                </li>
                <li class="page-item disabled" aria-disabled="true" v-else>
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>

                <template v-for="element in elements">
                    <template v-if="element === '...'">
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">{{ element }}</span>
                    </li>
                    </template>
                    <template v-for="(url, page) in element" v-else>
                        <li class="page-item active" aria-current="page" v-if="page == paginator.current_page">
                            <span class="page-link">{{ page }}</span>
                        </li>
                        <li class="page-item" v-else-if="page > 0">
                            <a class="page-link" v-bind:href="url">{{ page }}</a>
                        </li>
                    </template>
                </template>

                <li class="page-item" v-if="paginator.next_page_url">
                    <a class="page-link" v-bind:href="paginator.next_page_url" rel="next">&rsaquo;</a>
                </li>
                <li class="page-item disabled" aria-disabled="true" v-else>
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['pageType'],
        data() {
            return {
                paginator: {},
                elements: []
            }
        },
        created() {
            this.fetchPaginationData();
        },
        methods: {
            fetchPaginationData() {
                axios.get('/api/' + this.pageType + '/fetch', {
                    params: {
                        page: this.getQueryString('page')
                    }
                }).then(function (response) {
                    this.paginator = response.data.paginator;
                    this.elements = response.data.elements;
                }.bind(this)).catch(function () {
                    console.log('获取分页数据失败');
                });
            },
            getQueryString(name) {
                let reg = `(^|&)${name}=([^&]*)(&|$)`;
                let r = window.location.search.substr(1).match(reg);
                if (r != null)
                    return unescape(r[2]);
                return 1;
            }
        }
    }
</script>