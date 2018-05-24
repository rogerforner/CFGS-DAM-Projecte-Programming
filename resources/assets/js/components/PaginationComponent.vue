<template>
    <nav aria-label="Pagination">
        <ul class="pagination">
            <!-- Primera pàgina -->
            <li :class="pagination.current_page <= 1 ? 'page-item disabled' : 'page-item'">
                <a class="page-link" href="#" aria-label="First"
                   @click.prevent="changePage(1)">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">First</span>
                </a>
            </li>
            <!-- Pàgina anterior -->
            <li :class="pagination.current_page <= 1 ? 'page-item disabled' : 'page-item'">
                <a class="page-link" href="#" aria-label="Previous"
                   @click.prevent="changePage(pagination.current_page - 1)">
                <span aria-hidden="true">&lt;</span>
                <span class="sr-only">Previous</span>
                </a>
            </li>
            <!-- Numeració -->
            <li v-for="page in pages" :key="page.id"
                :class="isCurrentPage(page) ? 'page-item active' : 'page-item'">
                <a class="page-link" href="#"
                   @click.prevent="changePage(page)">
                    {{ page }}
                </a>
            </li>
            <!-- Pàgina següent -->
            <li :class="pagination.current_page >= pagination.last_page ? 'page-item disabled' : 'page-item'">
                <a class="page-link" href="#" aria-label="Next"
                   @click.prevent="changePage(pagination.current_page + 1)">
                <span aria-hidden="true">&gt;</span>
                <span class="sr-only">Next</span>
                </a>
            </li>
            <!-- Última pàgina -->
            <li :class="pagination.current_page >= pagination.last_page ? 'page-item disabled' : 'page-item'">
                <a class="page-link" href="#" aria-label="Last"
                   @click.prevent="changePage(pagination.last_page)">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Last</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<style>
    .pagination {
        margin-top: 40px;
    }
</style>

<script>
    export default {
        props: ['pagination', 'offset'],
        methods: {
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        },
        computed: {
            pages() {
                let pages = [];
                let from = this.pagination.current_page - Math.floor(this.offset / 2);
                if (from < 1) {
                    from = 1;
                }
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                while (from <= to) {
                    pages.push(from);
                    from++;
                }
                return pages;
            }
        }
    }
</script>